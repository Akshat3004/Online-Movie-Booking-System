# Security status — legacy coursework application

**Not suitable for production or publicly accessible deployment.**

This repository contains a historical PHP cinema booking prototype, not a hardened service. An initial code review identified multiple security and reliability issues:

- **Authentication:** \`login.php\` hashes passwords with MD5, which is unsuitable for storing passwords. Account registration and sign-in use legacy handling.
- **SQL injection:** several PHP handlers build SQL strings by directly concatenating request or session values. Fixing one query does **not** make the rest safe.
- **Authorization:** admin and booking operations need systematic authentication/role validation.
- **CSRF / input validation:** form actions do not consistently enforce anti-CSRF tokens or robust server-side validation.
- **Seat reservation races:** concurrent bookings need transactions and unique constraints; relying on PHP loops is insufficient.
- **Payments:** a card-data-themed UI is present without a verified payment-gateway integration. Never enter real credit-card details.
- **Historical data:** the \`iwp.sql\` dump contains sample user/booking records. Do not assume those records are sanitized for reuse in a public live database.

The portfolio documentation and \`db.php\` local environment configuration are improvements, **not a full security remediation**. Before a real deployment, rebuild authentication and payment handling, audit every SQL path, sanitize the sample dataset, rotate all previously exposed credentials, and add comprehensive security/integration tests.

If you encounter a vulnerability, do not test it against other people's deployments or accounts. Use a local test environment you control.
