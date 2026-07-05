<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

/**
 * AuditObserver
 *
 * Intercepts Eloquent created / updated / deleted events on auditable models
 * and writes an immutable row to audit_logs.
 *
 * Register this observer in AppServiceProvider::boot() against each model
 * that should be audited.
 */
class AuditObserver
{
    /**
     * Handle the "created" event.
     */
    public function created(Model $model): void
    {
        $this->log('created', $model, null, $model->getAttributes());
    }

    /**
     * Handle the "updated" event.
     */
    public function updated(Model $model): void
    {
        $this->log('updated', $model, $model->getOriginal(), $model->getAttributes());
    }

    /**
     * Handle the "deleted" event.
     */
    public function deleted(Model $model): void
    {
        $this->log('deleted', $model, $model->getOriginal(), null);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Write a single audit_log row.
     *
     * @param  string      $action      created|updated|deleted
     * @param  Model       $model       The Eloquent model instance
     * @param  array|null  $oldValues   Original attribute values (before change)
     * @param  array|null  $newValues   Current attribute values (after change)
     */
    private function log(
        string $action,
        Model $model,
        ?array $oldValues,
        ?array $newValues,
    ): void {
        // Avoid infinite loops: do not audit AuditLog itself.
        if ($model instanceof \App\Models\AuditLog) {
            return;
        }

        AuditLog::create([
            'user_id'    => auth()->id(),
            'username'   => auth()->user()?->name ?? 'system',
            'ip_address' => request()?->ip(),
            'action'     => $action,
            'model_type' => get_class($model),
            'model_id'   => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}
