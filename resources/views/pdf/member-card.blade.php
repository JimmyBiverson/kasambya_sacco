<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Member Card — {{ $member->full_name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── Page / Card Layout ── */
        .page {
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        /* ID card: 85.6 mm × 54 mm — scaled to approx 323px × 204px at 96dpi */
        .card {
            width: 323px;
            height: 204px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #1a6e3e;
            position: relative;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        /* Card header strip */
        .card-header {
            background: #1a6e3e;
            color: #fff;
            padding: 6px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header .org-name {
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .card-header .reg-no {
            font-size: 8px;
            opacity: 0.85;
        }

        /* Card body */
        .card-body {
            display: flex;
            padding: 10px;
            gap: 10px;
        }

        /* Photo column */
        .photo-col {
            flex-shrink: 0;
        }
        .photo-box {
            width: 65px;
            height: 80px;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            background: #e8f5e9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .photo-box img {
            width: 65px;
            height: 80px;
            object-fit: cover;
        }
        .photo-placeholder {
            font-size: 9px;
            color: #888;
            text-align: center;
            padding: 5px;
        }

        /* Info column */
        .info-col {
            flex: 1;
        }
        .member-full-name {
            font-size: 12px;
            font-weight: bold;
            color: #1a6e3e;
            margin-bottom: 4px;
        }
        .info-row {
            font-size: 9px;
            margin-bottom: 2px;
            color: #333;
        }
        .info-row span.label {
            color: #888;
            min-width: 60px;
            display: inline-block;
        }
        .membership-number {
            font-size: 11px;
            font-weight: bold;
            color: #f59e0b;
            background: #1a6e3e;
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            margin-top: 4px;
            letter-spacing: 1px;
        }

        /* QR column */
        .qr-col {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
        }
        .qr-col img {
            width: 55px;
            height: 55px;
        }
        .qr-label {
            font-size: 7px;
            color: #888;
            margin-top: 2px;
        }

        /* Card footer strip */
        .card-footer {
            background: #f59e0b;
            color: #1a1a1a;
            padding: 4px 10px;
            font-size: 8px;
            text-align: center;
            font-weight: bold;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        /* ── Page footer ── */
        .page-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="page">
    <div>
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header">
                <div>
                    <div class="org-name">{{ $org_name }}</div>
                    <div class="reg-no">Reg. No. {{ $reg_no }}</div>
                </div>
                <div class="reg-no" style="text-align:right;">MEMBER CARD</div>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                {{-- Photo --}}
                <div class="photo-col">
                    <div class="photo-box">
                        @if($member->photo)
                            <img src="{{ public_path('storage/' . $member->photo) }}" alt="Photo">
                        @else
                            <div class="photo-placeholder">No<br>Photo</div>
                        @endif
                    </div>
                </div>

                {{-- Member Info --}}
                <div class="info-col">
                    <div class="member-full-name">{{ $member->full_name }}</div>
                    <div class="info-row">
                        <span class="label">Category:</span>
                        {{ $member->category }}
                    </div>
                    <div class="info-row">
                        <span class="label">Branch:</span>
                        {{ $member->branch?->name ?? '—' }}
                    </div>
                    <div class="info-row">
                        <span class="label">Phone:</span>
                        {{ $member->phone }}
                    </div>
                    @if($member->joined_at)
                    <div class="info-row">
                        <span class="label">Since:</span>
                        {{ $member->joined_at->format('M Y') }}
                    </div>
                    @endif
                    <div class="membership-number">{{ $member->membership_number }}</div>
                </div>

                {{-- QR Code --}}
                <div class="qr-col">
                    @if($member->qr_code_path && file_exists(storage_path('app/' . $member->qr_code_path)))
                        <img src="{{ storage_path('app/' . $member->qr_code_path) }}" alt="QR Code">
                    @else
                        <div style="width:55px;height:55px;border:1px dashed #ccc;display:flex;align-items:center;justify-content:center;">
                            <span style="font-size:8px;color:#aaa;text-align:center;">No<br>QR</span>
                        </div>
                    @endif
                    <div class="qr-label">Scan to verify</div>
                </div>
            </div>

            {{-- Card Footer --}}
            <div class="card-footer">
                If found, please return to {{ $org_name }}
                @if($org_phone) &mdash; {{ $org_phone }} @endif
            </div>
        </div>

        <div class="page-footer">
            Generated by {{ $generated_by }} on {{ $generated_at }}
        </div>
    </div>
</div>

</body>
</html>
