# Movie Ticket Booking System

**PHP · MySQL/MariaDB · HTML/CSS · Session-based web application**

A cinema reservation project with movie listings, show schedules, seat selection, booking history, and separate administrative screens for managing movies, theaters, and shows.

> **Status: legacy academic prototype (2021).** This project demonstrates the booking flow and relational database integration, **but it is not currently secure for public deployment or real payment processing**. The original PHP application still uses MD5 password hashes, interpolated SQL in several handlers, and lacks modern CSRF and authorization protections. See [SECURITY.md](SECURITY.md) before running it.

## What the application includes

| Feature | Relevant files |
| --- | --- |
| Movie catalog and upcoming shows | [index.php](index.php), [movieLIst2.php](movieLIst2.php), [MovieCarousel.php](MovieCarousel.php) |
| Login and registration | [login.php](login.php), [logout.php](logout.php) |
| Movie, show, and seat selection | [booking.php](booking.php), [seat.php](seat.php) |
| Booking and ticket views | [process.php](process.php), [ticket.php](ticket.php), [bookinglist.php](bookinglist.php) |
| Admin views | [admin.php](admin.php), [AddMovie.php](AddMovie.php), [addtheater.php](addtheater.php), [addShows1.php](addShows1.php) |
| MySQL schema and legacy seed data | [iwp.sql](iwp.sql) |

### Booking flow

~~~mermaid
flowchart LR
 A[Browse movies] --> B[Select show]
 B --> C[Select seats]
 C --> D[Demo payment screen]
 D --> E[Booking record]
 E --> F[Ticket and booking history]
~~~

**Payments:** The UI displays a card-details form, but the repository does not include a verified payment-gateway integration. **Do not enter real payment card details.**

## Original UI screenshots

Screenshots are preserved from the original project presentation:

| Admin & scheduling | Booking experience |
| --- | --- |
| [Admin dashboard](https://user-images.githubusercontent.com/81208991/137348095-844409c0-194f-4c45-8631-9ee5c2239f12.png) | [Home page](https://user-images.githubusercontent.com/81208991/137348113-e08b2b87-b8c7-42da-ae87-e78e563327a9.png) |
| [Add show](https://user-images.githubusercontent.com/81208991/137348107-f317e371-8a11-4b80-96cb-01223f694dd2.png) | [Seat selection](https://user-images.githubusercontent.com/81208991/137349502-86132d58-49a7-4a43-ab20-96cb-01223f694dd2.png) |
| [Booking history](https://user-images.githubusercontent.com/81208991/137349713-448dca9f-01b4-4309-82b9-1c46dab80ac6.png) | [Ticket](https://user-images.githubusercontent.com/81208991/137349665-6206104c-005f-4972-80c7-7881c4a957cd.png) |

## Running locally for code review

**Use a local-only development environment with synthetic test accounts. Do not expose the application to the public internet.**

Requirements: PHP with MySQLi, MySQL or MariaDB, and a local PHP web server (or XAMPP/MAMP).

1. Clone the project and create an isolated local database called \`iwp\`.
2. Review [iwp.sql](iwp.sql) **before importing it**: it is a historical SQL dump containing seed records, including user records. Prefer a sanitized local fixture for shared demonstrations.
3. Set database settings as environment variables: \`DB_HOST\`, \`DB_USER\`, \`DB_PASSWORD\`, and \`DB_NAME\`. \`db.php\` uses \`127.0.0.1\`, \`root\`, an empty password, and \`iwp\` as local defaults only.
4. Start the PHP server from the project directory:

~~~bash
DB_HOST=127.0.0.1 DB_USER=root DB_NAME=iwp php -S 127.0.0.1:8000
~~~

Open \`http://127.0.0.1:8000/login.php\`. Confirm that you are using a local-only copy of the database. These steps explain how to inspect the legacy prototype; they are **not a claim that the entire booking and login flow has been revalidated**.

### Checks

~~~bash
find . -name '*.php' -print0 | xargs -0 -n1 php -l
~~~

A GitHub Actions workflow also runs PHP syntax checks. Linting is **not** a functional or security test.

## Known limitations and next improvements

- Replace MD5 authentication with \`password_hash\` and \`password_verify\`, using a controlled migration for existing hashes.
- Replace dynamically concatenated SQL queries with parameterized statements across **all** endpoints.
- Add authentication/role checks on admin and booking endpoints, CSRF protection, and server-side input validation.
- Use atomic booking transactions and database uniqueness constraints to avoid concurrent duplicate seat reservations.
- Treat the payment screen as a mock flow; use a hosted payment provider rather than accepting or storing real card information.
- Replace historical sample data with new synthetic fixtures before publishing an independently deployable portfolio version.
- Add reproducible integration tests and then verify a local demo end-to-end.

See [SECURITY.md](SECURITY.md) for additional cautions and [docs/ORIGINAL_README.md](docs/ORIGINAL_README.md) for the original project presentation.

**Portfolio positioning:** an early full-stack PHP/MySQL coursework project demonstrating schema-backed booking workflows, not a secure commercial ticketing platform.
