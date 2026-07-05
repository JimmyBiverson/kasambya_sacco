# Kasambya SACCO - Image Placement Guide

This document lists every image placeholder used across the site's Blade views. Place the actual image files at the paths shown below.

## Directory Structure

```
public/images/
├── about-office.jpg
├── building.jpg
├── m-sacco-phone.png
├── team/
│   ├── manager.jpg
│   ├── accountant.jpg
│   ├── credit-supervisor.jpg
│   ├── ict-officer.jpg
│   ├── loan-officer.jpg
│   ├── loan-admin.jpg
│   ├── person-1.jpg
│   └── person-2.jpg
├── membership/
│   ├── registration.jpg
│   ├── account-opening.jpg
│   └── saving-culture.jpg
├── news/
│   ├── news-1.jpg
│   ├── news-2.jpg
│   ├── news-3.jpg
│   ├── adm-2026.jpg
│   ├── coffee-seedlings.jpg
│   ├── green-financing.jpg
│   ├── msacco-launch.jpg
│   ├── annual-report.jpg
│   ├── financial-literacy.jpg
│   └── featured-article.jpg
├── partners/
│   ├── stanbic.png
│   ├── pearl.png
│   ├── ms.png
│   ├── ucsu.png
│   └── umra.png
├── slides/
│   ├── slide-1.jpg
│   ├── slide-2.jpg
│   ├── slide-3.jpg
│   ├── slide-4.jpg
│   └── slide-5.jpg
└── reports/
    └── report-thumbnail.jpg
```

## Complete Image Inventory

| # | File Path | Description | Dimensions | Used In |
|---|-----------|-------------|------------|---------|
| 1 | `public/images/about-office.jpg` | SACCO office photo | ~600x400px | `about.blade.php` - about-image |
| 2 | `public/images/building.jpg` | SACCO building exterior | ~600x380px | `home.blade.php` - built-image |
| 3 | `public/images/m-sacco-phone.png` | Phone mockup illustration | ~280x500px | `home.blade.php` - msacco-phone, `msacco.blade.php` - phone-mockup |
| 4 | `public/images/team/manager.jpg` | Byamukama Bernard (SACCO Manager) | 300x300px | `about.blade.php`, `history.blade.php`, `manager-message.blade.php` |
| 5 | `public/images/team/accountant.jpg` | Ampeire Charity (Accountant) | 300x300px | `about.blade.php`, `history.blade.php` |
| 6 | `public/images/team/credit-supervisor.jpg` | Ssebayima Edwine (Credit Supervisor) | 300x300px | `about.blade.php` |
| 7 | `public/images/team/ict-officer.jpg` | Nyakato Rose (ICT Officer) | 300x300px | `about.blade.php` |
| 8 | `public/images/team/loan-officer.jpg` | Kizito Richard (Loan Officer) | 300x300px | `about.blade.php` |
| 9 | `public/images/team/loan-admin.jpg` | Loan Administrator | 300x300px | `history.blade.php` |
| 10 | `public/images/team/person-1.jpg` | Board member / leader photo | 80x80px | `home.blade.php` - person-circle |
| 11 | `public/images/team/person-2.jpg` | Board member / leader photo | 80x80px | `home.blade.php` - person-circle |
| 12 | `public/images/membership/registration.jpg` | Member registration illustration | 350x200px | `home.blade.php` - membership images |
| 13 | `public/images/membership/account-opening.jpg` | Account opening process | 350x200px | `home.blade.php` - membership images |
| 14 | `public/images/membership/saving-culture.jpg` | Saving culture illustration | 350x200px | `home.blade.php` - membership images |
| 15 | `public/images/news/news-1.jpg` | News article 1 (Dividends) | 370x200px | `home.blade.php` - news section |
| 16 | `public/images/news/news-2.jpg` | News article 2 (AGM) | 370x200px | `home.blade.php` - news section |
| 17 | `public/images/news/news-3.jpg` | News article 3 (M-SACCO) | 370x200px | `home.blade.php` - news section |
| 18 | `public/images/news/adm-2026.jpg` | ADM 2026 event photo | 370x220px | `news.blade.php` - article 1 |
| 19 | `public/images/news/coffee-seedlings.jpg` | Coffee seedlings distribution | 370x220px | `news.blade.php` - article 2 |
| 20 | `public/images/news/green-financing.jpg` | Green financing training | 370x220px | `news.blade.php` - article 3 |
| 21 | `public/images/news/msacco-launch.jpg` | M-SACCO launch event | 370x220px | `news.blade.php` - article 4 |
| 22 | `public/images/news/annual-report.jpg` | Annual report cover | 370x220px | `news.blade.php` - article 5 |
| 23 | `public/images/news/financial-literacy.jpg` | Financial literacy workshop | 370x220px | `news.blade.php` - article 6 |
| 24 | `public/images/news/featured-article.jpg` | Featured article hero | 800x420px | `news-show.blade.php` - featured-image |
| 25 | `public/images/partners/stanbic.png` | Stanbic Bank logo | 160x80px | `home.blade.php` - partners section |
| 26 | `public/images/partners/pearl.png` | Pearl Bank logo | 160x80px | `home.blade.php` - partners section |
| 27 | `public/images/partners/ms.png` | MS logo | 160x80px | `home.blade.php` - partners section |
| 28 | `public/images/partners/ucsu.png` | UCSU logo | 160x80px | `home.blade.php` - partners section |
| 29 | `public/images/partners/umra.png` | UMRA logo | 160x80px | `home.blade.php` - partners section |
| 30 | `public/images/slides/slide-1.jpg` | Hero slide 1 (office/meeting) | 1360x600px | `home.blade.php` - hero slider |
| 31 | `public/images/slides/slide-2.jpg` | Hero slide 2 (staff/team) | 1360x600px | `home.blade.php` - hero slider |
| 32 | `public/images/slides/slide-3.jpg` | Hero slide 3 (leadership) | 1360x600px | `home.blade.php` - hero slider |
| 33 | `public/images/slides/slide-4.jpg` | Hero slide 4 (office exterior) | 1360x600px | `home.blade.php` - hero slider |
| 34 | `public/images/slides/slide-5.jpg` | Hero slide 5 (M-SACCO) | 1360x600px | `home.blade.php` - hero slider |
| 35 | `public/images/reports/report-thumbnail.jpg` | Report thumbnail | ~80x80px | `reports.blade.php` - table-header |

## Files Verified (No Image Placeholders)

These files were checked and have no image placeholder elements:
- `services.blade.php` - uses SVG icons only
- `loan-products.blade.php` - uses emoji/icons only
- `contact.blade.php` - no image placeholders
- `application.blade.php` - no image placeholders
- `careers.blade.php` - no image placeholders
