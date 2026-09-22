# MASTER PROMPT — Ibn Zaidon Academy Student App (Flutter)

> Copy everything below this line into the AI coding assistant.
> Work is delivered in phases (see section 12). Start with Phase 0 and wait for me to say **"next"** before each following phase.

---

## 0. Your role

You are a **senior Flutter architect and a top-tier mobile UI/UX designer** in one person. You write production-grade code that would pass a strict code review at a top company, and you design interfaces that look like award-winning apps (think Duolingo × Coursera × Apple-level polish, with a calm premium academic identity).

Build the **student mobile app** for **Ibn Zaidon Educational Academy** (أكاديمية ابن زيدون التعليمية), a Jordanian e-learning platform: recorded video courses, PDF worksheets, exams with instant analysis, previous-year exams, question banks, teachers, notifications.

The backend already exists (Laravel + Sanctum). **Do not invent endpoints.** Use only the contract in section 6. Where the contract is incomplete I say so explicitly — follow the instructions there.

Hard rules for everything you output:
1. **Complete files only.** No `// ...rest of code`, no placeholders, no pseudo-code. Every file must compile.
2. **Clean Code + Clean Architecture + BLoC** (sections 2–4). No exceptions, no shortcuts "for now".
3. **Zero hardcoded user-facing strings** (use localization) and **zero hardcoded colors/sizes in widgets** (use the design system).
4. **Arabic (RTL) is the primary language**, English (LTR) is fully supported. Every screen must look perfect in both.
5. Explain decisions briefly, then give code. Do not pad with generic advice.

---

## 1. Tech stack (use latest stable versions; pin them in `pubspec.yaml`)

| Concern | Package |
|---|---|
| Language / SDK | Flutter stable, Dart 3.x, null-safety, sound records/sealed classes where useful |
| State management | `flutter_bloc`, `bloc`, `equatable` (or `freezed` unions for states/events — choose ONE style and use it everywhere) |
| DI | `get_it` + `injectable` (code-gen) |
| Networking | `dio` (+ interceptors), `retrofit` optional; **no raw `http` calls inside features** |
| Models / JSON | `freezed`, `json_serializable` |
| Functional errors | `fpdart` (or `dartz`) → `Either<Failure, T>` |
| Routing | `go_router` (typed routes, auth redirect guard, deep links) |
| Local storage | `flutter_secure_storage` (token, deviceId), `hive_ce` / `shared_preferences` (cache & settings) |
| Localization | Flutter `gen_l10n` (`.arb`) — `ar` (default) + `en` |
| Design | Material 3, `google_fonts` (Cairo for Arabic, Plus Jakarta Sans/Inter for Latin), `flutter_animate`, `shimmer`, `lottie`, `flutter_svg`, `cached_network_image` |
| Media | `youtube_player_iframe` (or `webview_flutter`) for lesson videos, `pdfx` or `syncfusion_flutter_pdfviewer` for PDFs, `url_launcher`, `share_plus` |
| Push | `firebase_core`, `firebase_messaging`, `flutter_local_notifications` |
| Payments (iOS) | `in_app_purchase` (StoreKit 2) |
| Device | `device_info_plus`, `uuid`, `connectivity_plus`, `package_info_plus` |
| Quality | `very_good_analysis` lint rules, `bloc_test`, `mocktail`, `golden_toolkit` (or built-in goldens) |

Flavors: `dev` and `prod` (different base URL, app name, bundle id suffix) via `--dart-define` + a typed `AppConfig`.

---

## 2. Architecture — Clean Architecture, feature-first

```
lib/
├─ main_dev.dart / main_prod.dart
├─ app/                      # App widget, router, theme wiring, bootstrap
├─ core/
│  ├─ config/                # AppConfig (baseUrl, flavor)
│  ├─ di/                    # get_it + injectable setup
│  ├─ error/                 # Failure hierarchy, exceptions, error mapper
│  ├─ network/               # DioClient, interceptors (auth, locale, logging, retry, error), ApiResponse<T>, Pagination
│  ├─ storage/               # SecureStorage, KeyValueStore, Cache (stale-while-revalidate)
│  ├─ usecase/               # abstract UseCase<Out, Params>
│  ├─ utils/                 # tolerant parsers (num/String→double), date formatting, debouncer, extensions
│  └─ l10n/                  # arb files + generated
├─ design_system/            # tokens, theme, components (see section 8)
├─ features/
│  └─ <feature>/
│     ├─ data/
│     │  ├─ datasources/     # remote (+ local when cached)
│     │  ├─ models/          # DTOs: fromJson/toJson, mapper → entity
│     │  └─ repositories/    # implements domain repository
│     ├─ domain/
│     │  ├─ entities/        # pure Dart, immutable
│     │  ├─ repositories/    # abstract interfaces
│     │  └─ usecases/        # one class = one action
│     └─ presentation/
│        ├─ bloc/            # <feature>_bloc.dart, _event.dart, _state.dart
│        ├─ pages/           # route-level screens (thin)
│        └─ widgets/         # feature widgets (small, reusable, const where possible)
└─ shared/                   # cross-feature widgets/entities (e.g. PagedList, Teacher card)
```

**Dependency rule (enforce it):** `presentation → domain ← data`. `domain` imports **nothing** from Flutter, Dio, or `data`. Widgets never touch repositories/datasources directly — only Blocs. Blocs call **use cases** only.

Features (each with the full folder structure above):
`auth`, `home`, `catalog` (categories → subjects), `courses` (list/detail/my-courses/activation/purchase), `lessons` (player + progress), `exams` (list/detail/take/result/history), `teachers`, `library` (previous-year exams, question banks, worksheets), `notifications`, `profile` (view/edit/password/delete), `settings` (language/theme/about), `splash_onboarding`.

---

## 3. Clean-code standards (non-negotiable)

- Files ≤ ~250 lines, widgets ≤ ~120 lines: **extract** sub-widgets into classes (not helper methods returning widgets). `const` constructors everywhere possible.
- One responsibility per class. Meaningful names. No abbreviations, no magic numbers/strings (use tokens/constants).
- No business logic in widgets. No `setState` for anything except purely local ephemeral UI (e.g. a focus/animation controller).
- Immutability: entities, states, events are immutable (`freezed`/`Equatable`).
- Error handling is explicit: data layer catches `DioException` → maps to a typed `Failure` (`NetworkFailure`, `UnauthorizedFailure`, `ForbiddenFailure(message)`, `ValidationFailure(fieldErrors)`, `NotFoundFailure`, `ServerFailure`, `UnknownFailure`). Repositories return `Either<Failure, T>`. Blocs never see `DioException`.
- Doc comments only where the *why* isn't obvious. No commented-out code.
- Everything injectable & mockable. Provide unit tests as specified in section 11.
- Lint: `very_good_analysis`, **zero analyzer warnings**.

---

## 4. BLoC standards

- One Bloc per screen/feature concern. Events are **user/system intents in past or imperative form** (`CoursesRequested`, `CoursesNextPageRequested`, `CoursesRefreshed`, `CoursesSearchChanged`), states are **data snapshots**.
- State shape for lists: `status` (`initial | loading | success | failure | loadingMore`), `items`, `page`, `hasReachedMax`, `failure?`. Use one reusable `PaginatedState<T>` + a mixin/helper to avoid copy-paste.
- Use `bloc_concurrency` transformers: `restartable()` for search (with 400 ms debounce), `droppable()` for submit/purchase, `sequential()` where order matters.
- One-shot side effects (snackbar, navigation, dialogs) via `BlocListener` with a dedicated `listenWhen` — **never** put them in `builder`.
- Global blocs (provided at app root): `AuthBloc` (session), `SettingsCubit` (locale/theme), `NotificationsBadgeCubit`. Screen blocs are created in the route (`BlocProvider`) and closed with it.
- Every Bloc has `bloc_test` coverage for its main flows.

---

## 5. Project-wide behaviors

**Session & auth**
- Token stored in `flutter_secure_storage`. Auth interceptor adds `Authorization: Bearer <token>` and `Accept-Language: ar|en` (from `SettingsCubit`) and `Accept: application/json`.
- On **401** anywhere (except login/register): clear session, reset `AuthBloc` → router redirects to login (with a friendly "session expired" message).
- Guest browsing is allowed for: banners, categories, subjects, course detail, teacher detail, exam detail(metadata), file libraries. Anything requiring auth (`units`, `lessons`, `home`, `courses` list, `exams` list, start exam, my-courses, profile, notifications…) shows a polished **"Sign in to continue"** gate instead of an error.
- `deviceId`: generate a UUID v4 **once**, persist in secure storage (must be ≤ 36 chars), send on register/login. Never regenerate.

**Networking**
- Base URL: `{AppConfig.baseUrl}/api/v1/student/`
- Timeouts (connect 15 s, receive 30 s), one automatic retry for idempotent GETs on network errors, exponential backoff.
- Logging interceptor only in `dev`; **never log tokens or passwords**.
- Connectivity: global offline banner; lists show cached data (stale-while-revalidate) for `home`, `categories`, `banners`, `my-courses` when offline.

**Tolerant parsing (backend quirks — implement helpers in `core/utils`)**
- Decimals (`price`, `old_price`, `average_rating`, `percentage`) can arrive as **numbers or numeric strings** ("12.50") → always parse via `parseDouble(dynamic)`.
- Booleans may arrive as `true/false` or `1/0`.
- Image URLs are already absolute — use as-is; if null show a designed placeholder (never a broken image).
- Dates: `Y-m-d` or `Y-m-d H:i` strings.
- `progress` in `GET courses/{id}` is **0..1**, while `progress_percentage` in `my-courses` is **0..100** → normalize to 0..1 in the mapper.

**Backend messages are Arabic-only strings.** Do NOT show `message` blindly. Map by HTTP status/known cases to localized strings from `.arb`; use server `message` only as a fallback for 403/422 business rules (e.g. "activate the course first").

**Currency**: Jordanian Dinar — show `JOD` / `د.أ` per locale, 2 decimals, `Intl` formatting.

**App Store price rule (important)**: call `GET app-settings` at startup. If `show_price == 0`, **hide every price, old price, discount badge and "buy" button everywhere** (Apple review compliance). Course access is then via card activation / already-enrolled only. Model this as an `AppSettingsCubit` consumed by all price widgets through a single `PriceView` widget.

---

## 6. Backend contract (Laravel API)

Base: `/api/v1/student/` · Auth: Sanctum Bearer · Locale header: `Accept-Language: ar|en`

**Envelope**
```json
{ "status": true|false, "message": "…", "data": <any> }
```
Paginated lists add: `"pagination": { "current_page", "last_page", "per_page", "total" }` (query param `page`). Errors: `{ "status": false, "message": "…", "errors": { field: [msgs] } }` (422 validation). Notifications list also returns top-level `"unread_count"`.

### Public
| Method & path | Notes / response fields |
|---|---|
| `POST auth/register` | body: `name*, phone*, password*, password_confirmation*, deviceId*, email?, class_id?` → `data:{ token, student }` (201). `student`: `id,name,email,phone,avatar,class,class_id,gender,is_active,app_account_token` |
| `POST auth/login` | body: `phone*, password*, deviceId*` → same shape. 401 wrong credentials, 403 suspended account |
| `GET app-settings` | `data:{ show_price: 0|1 }` |
| `GET banners` | `data:[{ id, image, order_index }]` → hero slider |
| `GET categories` | root categories: `id,name,name_ar,name_en,level,icon,image,has_children,subcategories_count` |
| `GET categories/{id}` | `data:{ category, children:[category…], subjects:[{ id,name,name_ar,name_en,icon,color_class,is_elective,category_id }] }` |
| `GET subjects/{id}` (optional auth) | `data:{ subject, courses:[course card] }` |
| `GET courses/{id}` (optional auth) | course detail (below). Adds `is_enrolled`, `progress` |
| `GET teachers/{id}` (optional auth) | teacher card + `bio, qualification, courses:[…]` |
| `GET exams/{id}` | exam card + `questions:[{ id, question_text, question_type, marks, image, options:[{ id, option_text }] }]` (no correct answers) |
| `GET previous-year-exams`, `GET question-banks`, `GET worksheets` (+ `/{id}`) | filters: `subject_id, year, search` (worksheets also `class_id`) · item: `id,title,tag,year,pages,file_size,pdf_url,subject{id,name},teacher{id,name},class{id,name}` · paginated (15) |

### Authenticated
| Method & path | Notes |
|---|---|
| `POST auth/logout` · `DELETE auth/delete-account` | delete-account = deactivate + revoke tokens (Apple-required feature) |
| `POST auth/switch-sibling/{siblingId}` | switch to a linked sibling account (admin-linked). **No endpoint lists siblings** → implement the use case + repository method, but keep the UI behind a feature flag until backend exposes siblings in `profile` |
| `GET home` | `data:{ categories, featured_courses, trending_courses, top_teachers, stats:{ total_students, total_teachers, total_courses } }` |
| `GET courses` | filters `category_id, subject_id, teacher_id, search, featured=1, trending=1`, paginated (15) |
| `GET teachers` | filter `search`, paginated |
| `GET exams` | filters `course_id, subject_id, exam_type, search`, paginated |
| `GET profile` / `PUT profile` | `PUT` body (all optional): `name, national_id, email, phone, gender(male|female), date_of_birth, nationality, class_id, avatar(file ≤2MB, multipart), password + password_confirmation + current_password`. Profile also returns `stats` |
| `GET my-courses` | `[{ enrollment_id, enrolled_at, progress_percentage, is_completed, completed_at, course{ id,title,thumbnail,duration_hours,difficulty_level,teacher,subject } }]` paginated |
| `GET my-exams` | attempts history `[{ attempt_id, score, total_marks, percentage, is_passed, time_taken_minutes, submitted_at, exam{ id,title,exam_type,course,subject } }]` paginated |
| `GET courses/{id}/units` | `data:{ course_id, course_name, is_enrolled, units:[{ id,title,description,order_index, lessons:[{ id,title,lesson_type(video|pdf|…),duration_minutes,order_index,is_free,is_locked,is_locked_by_sequence,video_url,file_url }], exams:[{ id,title,duration_minutes,total_questions,total_marks }] }] }` |
| `GET lessons/{id}` | `{ id,title,lesson_type,video_url(YouTube),file_url,duration_minutes,is_free,is_enrolled,unit_id,course_id }` · **403** = must activate course / finish previous lessons first (message explains) |
| `GET units/{id}/exams` | exams of a unit |
| `POST lessons/{id}/progress` | body `{ watch_seconds?, is_completed? }` → `{ lesson_id, watch_seconds, is_completed, course_progress:{ percentage, course_id }|null }`. Send `watch_seconds` every ~30 s while playing, and `is_completed:true` at video end / when the student taps "mark complete" on a PDF |
| `GET courses/{id}/my-progress` | `{ percentage, completed_lessons, total_lessons, completed_exams, total_exams, completed_lesson_ids[], watch_positions{ lessonId:{watch_seconds,is_completed} } }` → resume playback position |
| `POST exams/{id}/start` | `{ attempt_id, started_at, exam }` (201 new, 200 = an in-progress attempt already exists → **resume it**) |
| `POST attempts/{attempt}/submit` | body `{ answers:[{ question_id, option_id }] }` → `{ attempt_id, score, total_marks, percentage, correct_answers, wrong_answers, unanswered, is_passed, time_taken_minutes, answers?:[{ question_id, question_text, selected_option_id, is_correct, marks_earned, correct_option_id, correct_option, explanation }] }` — `answers` present only when exam's `show_result_immediately` is true |
| `POST courses/{id}/activate` | body `{ card_code }` → 201 `{ course_id, course_name }`; 422 for invalid/used code, wrong course/teacher/price, already enrolled |
| `POST purchases/apple/verify` (iOS only, throttled 20/min) | body `{ course_id, product_id, transaction_id (6–30 digits), signed_transaction, purchase_token (UUID = student.app_account_token), transaction_date?, source:"app_store" }` → `{ course_id, transaction_id, is_enrolled, environment }` |
| `POST device-token` | body `{ fcm_token }` — call after login and on token refresh |
| `GET notifications` | `[{ id,title,body,type,data,is_read,created_at }]` + `unread_count`, paginated (20) |
| `POST notifications/{id}/read` · `POST notifications/read-all` | |

**Course card**: `id,title,title_ar,title_en,description,thumbnail,price,old_price,is_free,can_purchase_via_store,discount,average_rating,total_students,duration_hours,difficulty_level,is_live,teacher{id,name,avatar},category{id,name},subject{id,name},class{id,name}`
**Course detail** adds: `what_you_learn, requirements, total_videos, total_pdfs, sequential, enrollments_count, units:[{ id,title,order_index, lessons:[{ id,title,lesson_type,duration_minutes,order_index,is_free }] }]`
**Teacher card**: `id,name,specialization,avatar,years_of_experience,average_rating,total_students,total_courses,is_verified`

### Payments — how a paid course is unlocked
- **iOS (App Store build):** StoreKit 2 non-consumable product. Product ID = `com.IbnZaidon.school.course.v2.<courseId>` (bundle id `com.IbnZaidon.school`). Flow: `in_app_purchase` → obtain signed transaction → `POST purchases/apple/verify` with `purchase_token = student.app_account_token` → on success mark enrolled and refresh course. Handle: cancelled, pending (Ask-to-Buy), restored purchases, verify failure with retry (never lose a paid transaction: complete the transaction **only after** the backend confirms), sandbox.
- **All platforms:** **card activation** (`POST courses/{id}/activate`) with a scratch-card code: polished input (auto-uppercase, dash grouping), clear success/error states.
- If `show_price == 0` → hide purchase UI entirely (see section 5).
- `course.can_purchase_via_store` is `true` for non-free courses.

---

## 7. Screens & UX flows (build all of these)

1. **Splash** → animated logo, checks session + `app-settings` + fetches locale → routes to onboarding / login / home.
2. **Onboarding** (3 slides, skippable, shown once): Lottie/illustrations, page-indicator morph, primary CTA.
3. **Login / Register**: phone + password (register: name, phone, optional email, password + confirm; optional class picker if data available). Live validation, inline server field errors (422), password visibility toggle, loading button state, keyboard-aware layout, "Continue as guest".
4. **Home** (tab 1): greeting + avatar + notification bell with badge; **auto-playing banner carousel** (parallax, indicator); horizontally scrolling **categories** chips/cards; **Featured** & **Trending** course carousels; **Top teachers**; platform **stats** strip (animated count-up); pull-to-refresh; shimmer skeletons; graceful per-section errors (a failing section must not break the page).
5. **Explore / Catalog** (tab 2): search bar (debounced) + category tree drill-down → children → subjects → subject page listing its courses. Breadcrumb header. Grid/list toggle.
6. **Course list** with filters sheet (category, subject, teacher, featured/trending), infinite scroll, pagination footer loader, empty state, retry.
7. **Course detail**: collapsing hero with thumbnail/gradient, title, teacher chip (→ teacher), rating, students, duration, difficulty, discount badge; sticky bottom action bar (Enroll/Buy/Activate/Continue learning with progress); tabs **Content / About / Reviews-placeholder**; units accordion showing lessons with type icon, duration, **lock state** (`is_locked`, `is_locked_by_sequence` with a clear explanation), unit exams; "What you'll learn" / requirements. Guest → sign-in gate on locked actions.
8. **Lesson player**: YouTube via iframe/WebView (fullscreen, rotate, keep-awake), resumes at saved `watch_seconds`, reports progress every 30 s + on completion, next/previous lesson navigation, PDF lessons open in an in-app viewer with a "Mark as complete" button; handles 403 gracefully (bottom sheet with reason + CTA).
9. **My Courses** (tab 3): progress rings/bars, completed badge, continue button, infinite scroll.
10. **Exams**: list (filters: type, subject, course), exam detail (questions count, duration, pass marks, difficulty, rules), **Exam-taking screen**: countdown timer (color shifts calm → warning → danger, never blocks UI), question navigator (answered/unanswered/flagged), previous/next, **local autosave of answers** (survive app kill; resume in-progress attempt), confirm-submit dialog with unanswered count, **auto-submit when time ends**, prevent accidental back (confirm). **Result screen**: animated circular score gauge, pass/fail state with celebration (confetti for pass), correct/wrong/unanswered stats, time taken, and — when `answers` is returned — a **review list** with correct answer + explanation; share result; retry.
11. **My Exams history** (inside Profile or Exams tab).
12. **Teachers**: list with search, teacher profile (avatar, verified badge, stats, bio, qualification, courses).
13. **Library** (tab 4 or Explore section): three segments — Previous-Year Exams, Question Banks, Worksheets — each with search, subject/year filters, file cards (pages, size, tag), open/download/share PDF with progress, cached for offline reading.
14. **Notifications**: list, unread styling, mark read / mark all read, tap → deep link by `type`/`data`, foreground/background FCM handling, permission prompt done tastefully (pre-permission explainer screen).
15. **Profile**: avatar upload (crop/compress ≤ 2 MB), edit form, change password (current + new + confirm), stats cards, language switch (AR/EN), theme (system/light/dark), about/version, **Logout**, **Delete account** (2-step destructive confirmation; required by App Store).
16. **Sibling switch (feature-flagged, default off):** `POST auth/switch-sibling/{siblingId}` exists but no endpoint lists siblings yet — build the use case/repository method now and hide the UI behind `FeatureFlags.siblingSwitch` until the backend exposes siblings in `profile`.

Navigation: bottom navigation bar with 4–5 tabs (Home, Explore, My Courses, Library, Profile) using `StatefulShellRoute` to preserve tab state; custom animated nav indicator.

---

## 8. Design system — "very high quality, awesome design"

Create `design_system/` **before** any screen. Everything below must be tokens/components, never inline.

**Brand identity** (taken from the existing website so the two products feel like one brand):
- Primary deep blue `#0B3D91` · Primary-dark (gradient end) `#1A4AB0` · Accent blue `#1E6BD6` · Highlight amber `#F5A623` · Success `#28A745` · Danger `#DC3545`.
- Build a full Material 3 `ColorScheme` (light + dark) from these with proper containers/on-colors, surface tones, and verify **WCAG AA contrast**.
- Signature gradient: `135°, #0B3D91 → #1A4AB0` for heroes and primary CTAs; amber used sparingly for highlights (ratings, badges, streaks).

**Typography**: Cairo (Arabic) + Plus Jakarta Sans/Inter (Latin), chosen by locale. Define a full type scale (display, headline, title, body, label) with proper Arabic line-heights (Arabic needs ~1.5–1.7). Support system font scaling up to 1.3× without overflow.

**Tokens**: 4-pt spacing scale; radii (chip 10 / card 20 / sheet 28); elevation via soft, layered, low-opacity shadows (not Material default); motion durations/curves (`fast 150ms`, `medium 300ms`, `slow 500ms`, emphasized-decelerate curve).

**Look & feel**
- Airy layouts, generous whitespace, large rounded cards, subtle glass/blur on overlays, gradient hero headers, soft tinted backgrounds per subject color (`color_class` from API mapped to a palette).
- Course card: 16:9 thumbnail with gradient scrim, teacher avatar, rating chip (amber star), price chip / "Free", discount ribbon (only when prices are visible), animated progress bar when enrolled.
- Custom **pull-to-refresh**, custom **snackbars/toasts**, custom **bottom sheets** and **dialogs** (all from the design system).
- **Motion**: staggered list entrance (`flutter_animate`), hero transitions for course thumbnails and teacher avatars, animated tab indicator, count-up stats, button press micro-interactions + light **haptics**, animated score gauge, confetti on passing an exam, Lottie for empty/error/success states.
- **Skeleton loaders (shimmer) for every async surface**; never a bare spinner on a full screen.
- **Empty / error / offline / gate states**: illustrated, friendly, with a clear primary action (retry, browse, sign in).
- **Dark mode** first-class (not an afterthought): true dark surfaces, adjusted gradients, images with subtle dimming.
- **RTL correctness**: use `EdgeInsetsDirectional`, `AlignmentDirectional`, `start/end`, mirrored icons (chevrons, back, progress direction). Test both directions.
- **Responsive**: phones first, but layouts adapt to tablets (max content width, 2–3 column grids) and landscape (video player).
- **Accessibility**: semantic labels, ≥ 48 dp touch targets, focus order, contrast AA, text-scale safe, reduce-motion respected.

**Reusable components to build** (in `design_system/components`): `AppButton` (primary/secondary/text/destructive, loading), `AppTextField` (validation, prefix/suffix, RTL-aware), `AppCard`, `CourseCard` (+ horizontal/compact variants), `TeacherAvatarCard`, `SectionHeader` (title + "see all"), `PriceView` (obeys `show_price`), `RatingChip`, `StatChip`, `ProgressRing`, `AppNetworkImage` (cache + placeholder + fade), `EmptyState`, `ErrorState`, `OfflineBanner`, `SignInGate`, `SkeletonBox/List`, `AppBottomSheet`, `AppDialog`, `AppSnackbar`, `PagedListView` (infinite scroll), `AppTabBar`, `AppBottomNav`, `ExamTimer`, `ScoreGauge`.

---

## 9. Localization (`gen_l10n`)

- `app_ar.arb` (default/template) and `app_en.arb`, **every** user-visible string, with placeholders/plurals (`{count} دورة`).
- Locale switch persisted; applies instantly without restart; updates `Accept-Language`.
- Numbers/dates/currency via `intl` per locale; Arabic-Indic digits **not** forced (keep Western digits consistent with the website).
- Server-provided content already arrives localized (`title`, `name` via `Accept-Language`); when the app locale changes, refetch visible screens.

---

## 10. Security & robustness

- Secure storage for token + deviceId; nothing sensitive in logs or shared prefs.
- Validate all inputs client-side too (phone format Jordan-friendly but tolerant, password ≥ 8).
- Prevent double submits (droppable events + disabled buttons).
- Screenshots/screen recording: enable `FLAG_SECURE`/iOS equivalent on **exam-taking and paid-video screens** (configurable).
- Graceful handling of: no internet, timeouts, 401/403/404/422/5xx, empty data, malformed JSON (never crash — map to `UnknownFailure` and report to a `CrashReporter` interface, Firebase Crashlytics implementation).
- App start must not depend on any single endpoint succeeding.

---

## 11. Testing (part of the deliverable, not optional)

- Unit tests: mappers/DTO parsing (including the tolerant-parsing edge cases), use cases, repositories (mock datasources), interceptors (401 handling).
- Bloc tests (`bloc_test`) for: auth, home, courses list (pagination/search/refresh), course detail (enroll/activate states), lesson progress, exam-taking (timer expiry, autosave, resume, submit), notifications.
- Widget/golden tests for the main design-system components in **light/dark × ar/en**.
- A short `README.md` explaining architecture, how to run flavors, how to generate code (`dart run build_runner build -d`), and how to add a new feature.

---

## 12. Delivery plan — phase by phase

Deliver **one phase per reply**, complete and compiling; end each phase with (a) the exact commands to run, (b) what to test manually, (c) any assumption about the backend. Wait for **"next"**.

- **Phase 0 — Foundation:** `pubspec.yaml`, folder structure, flavors + `AppConfig`, DI, `DioClient` + all interceptors, `Failure`/error mapping, `ApiResponse`/pagination models, tolerant parsers, secure storage, localization setup, router skeleton with auth guard.
- **Phase 1 — Design system:** tokens, light/dark theme (AR/EN fonts), and **all components in section 8**, plus a hidden "Design Gallery" page that shows every component in every state.
- **Phase 2 — Auth & app shell:** splash, onboarding, login, register, session handling, `AppSettingsCubit` (`show_price`), bottom-nav shell, settings (language/theme).
- **Phase 3 — Home & Catalog:** home (all sections), banners, categories tree, subject page.
- **Phase 4 — Courses:** list + filters, detail, units/lessons list with lock states, my-courses, card activation, iOS StoreKit purchase + verify.
- **Phase 5 — Lessons:** player (video + PDF), progress reporting, resume, sequential-lock handling.
- **Phase 6 — Exams:** list, detail, taking (timer/autosave/resume), result + review, history.
- **Phase 7 — Teachers & Library:** teachers list/profile; previous-year exams, question banks, worksheets with PDF open/download/cache.
- **Phase 8 — Notifications & Profile:** FCM setup, list/badge/deep links, profile edit, avatar upload, change password, logout, delete account.
- **Phase 9 — Sibling switch** (feature-flagged) and any remaining polish items.
- **Phase 10 — Hardening:** offline caching pass, performance pass (`const`, `RepaintBoundary`, image caching, list keys), accessibility pass, remaining tests, release checklist (app icons, splash, permissions, iOS/Android config, obfuscation flags).

---

## 13. Definition of done (check yourself before each reply)

- [ ] Compiles; zero analyzer warnings; no `dynamic` leaking past the data layer.
- [ ] Layering respected (no Flutter/Dio imports in `domain`; widgets only talk to Blocs).
- [ ] No hardcoded strings/colors/sizes in features.
- [ ] Loading (shimmer), empty, error, offline and guest-gate states exist for every screen.
- [ ] Looks correct in AR/RTL and EN/LTR, light and dark.
- [ ] Prices hidden everywhere when `show_price == 0`.
- [ ] Tests included for the phase.
- [ ] Nothing invented beyond the contract; every assumption listed.

**Begin now with Phase 0.**
