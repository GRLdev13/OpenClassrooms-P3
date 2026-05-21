# Transformez l'architecture d'une application existante

# Plot

Renote is an application that allows user to take and store notes.
In renote, a user can:
- create notes
- visualize notes
- define relationship between the notes
- define tags
- and associate a tag to a note.

## Routes

### Public Routes (Guest)

| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| GET | `/` | `home` | Show the public home page. |
| GET | `/login` | `login` | Show the login form. |
| POST | `/login` | `login.store` | Authenticate a user and start their session. |
| GET | `/register` | `register` | Show the registration form. |
| POST | `/register` | `register.store` | Create a new user account and log the user in. |
| GET | `/reset-password/{token}` | `password.reset` | Show the password reset form for a reset token. |
| POST | `/reset-password` | `password.update` | Update a user's password from a valid reset token. |

### Authentication Routes

| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| POST | `/logout` | `logout` | Log out the current user and invalidate their session. |

### Authenticated Routes (Auth Required)

#### Dashboard & Confirmation
| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| GET | `/dashboard` | `dashboard` | Show the authenticated user's notes dashboard. |
| GET | `/confirm-password` | `password.confirm` | Show the password confirmation form for protected actions. |
| POST | `/confirm-password` | `password.confirm.store` | Confirm the authenticated user's password. |

#### Notes Management
| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| POST | `/notes` | `notes.store` | Create a note for the authenticated user. |
| DELETE | `/notes/{note}` | `notes.delete` | Delete one of the authenticated user's notes. |

#### Tags Management
| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| POST | `/tags` | `tags.store` | Create a new tag. |

#### User Settings
| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| POST | `/user` | `user.update` | Update the authenticated user's profile information. |
| DELETE | `/delete` | `user.delete` | Delete the authenticated user's account. |
| POST | `/settings/password` | `settings.password.update` | Update the authenticated user's password from settings. |

#### Settings Pages (Volt Components)
| Method | URI | Route name | Purpose |
| --- | --- | --- | --- |
| GET | `/settings` | — | Redirect to the profile settings page. |
| GET | `/settings/profile` | `settings.profile` | Show the profile settings page. |
| GET | `/settings/password` | `settings.password` | Show the password settings page. |
| GET | `/settings/appearance` | `settings.appearance` | Show the appearance settings page. |

## Install

1. Install Laravel's Herd:
https://laravel.com/docs/12.x/installation#installation-using-herd

This will install Php, Composer and Laravel.

2. Install node v22

Install node version manager (MVN).
On Windows you can use this distribution:
https://github.com/coreybutler/nvm-windows#readme


3. Clone this project

4. Copy `.env.example` to `.env`

5. Generate new APP_KEY with `php artisan key:generate`

6. Run `npm i` and `npm run dev`

7. Run `php artisan migrate`

8. Start Herd

9. Access to Herd link from your browser

You are setup!
