# Final Project - Meide Mach Company Profile CMS

## Team Member

- [Akmal Rafi Diara Putra](https://www.github.com/akmalrafidiara)
- [Muhammad Hadiid Faathir](https://github.com/Bedyyy)
- [Rasyaad Maulana Khandiyas](https://www.github.com/rasyaadmk)
- [Muhammad Izzat Azizan](https://www.github.com/ijatajijan)
- [Delvino Ardi](https://www.github.com/delvinoardi7)
- [Narendra Arkan Putra Darmawan](https://www.github.com/ZoontS)

## How to run

### Requirement

- PHP version 7.4 or newer is required, with the _intl_ extension and _mbstring_ extension installed.
- MySQL via the MySQLi driver (version 5.1 and above only)
- Composer

Clone the project

```bash
  git clone https://github.com/akmalrafidiara/meide-mech-cms-backend.git
```

Go to the project directory

```bash
  cd meide-mech-cms-backend
```

Change brench

```bash
  git checkout sprint-<n>
```

`now brench 4`

- Create database on mysql
- Duplicate `env` and rename to `.env`
- Setting database on `.env`

Update package

```bash
  composer update
```

Create database tabel

```bash
  php spark migrate
```

Create user to login

```bash
  php spark db:seed UserSeeder
```

`username: admin`
`password: admin`

Start the server

```bash
  php spark serve
```
