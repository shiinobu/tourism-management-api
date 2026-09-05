# Security Policy

## Scope

This repository is a portfolio and learning project. Please report potential security issues responsibly rather than publishing sensitive details in a public issue.

## Reporting

For security concerns, contact the repository owner privately through their GitHub profile.

## Configuration

- Never commit `.env` files or production credentials.
- Keep application secrets in environment variables.
- Regenerate credentials immediately if a secret is accidentally exposed.

## File Uploads

The API validates uploaded tourism images by file type and size and generates server-side filenames before storing them.
