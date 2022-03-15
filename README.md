# lastmileoftheway

Website for creating custom funeral or memorial liturgies (orders of service).

## A2Hosting

- The actual domain is with [Google Domains](https://domains.google.com); you
configure the DNS settings there from the cPanel on A2Hosting.
- The SSH password is different from the password for logging into cPanel itself.
- Subdomains are added using cPanel, but then Google Domains must be used to add
  DNS records for those subdomains.
- AutoSSL is the service that regenerates free SSL certificates for this site.
  This service also works for subdomains, which is nice.
- This hosting service is cheaper than GoDaddy and seems to work well so far.
  The current PHP version selected is 8.1 to match what is used for Laravel Sail
  unless A2Hosting doesn't have what I need.

### How to update site on A2Hosting with the latest code

```bash
# SSH into A2Hosting's servers
# Reference URL: https://blog.netgloo.com/2015/08/06/configuring-godaddys-shared-hosting-for-laravel-and-git/
#
ssh lastmileoftheway.com

# Clone the code repo then rename the folder
mkdir -p ~/code/
cd ~/code/
git clone https://github.com/tap52384/lastmileoftheway.git
git clone https://github.com/tap52384/lastmileoftheway.git test
cp -nv ~/code/lastmileoftheway/.env.example ~/code/lastmileoftheway/.env
cp -nv ~/code/test/.env.example ~/code/test/.env

# Rename the original public_html folder
mv ~/public_html ~/public_html_original
# Create a symbolic link to the ~/code/lastmileoftheway/ folder
ln -s ~/code/lastmileoftheway/public public_html
# Make sure you have created the subdomain "test"
mv ~/public_html_test ~/public_html_test_original
# Create a symbolic link to the ~/code/test/ folder
# The public/ folder is where Laravel services its files from
ln -s ~/code/test/public public_html_test

# Download Composer and install packages
# The version of composer native to A2Hosting is very old (from 2020)
cd ~/code/test
curl -sS https://getcomposer.org/installer | php
# You may need to set an alias in ~/.bashrc so you can use the newer composer by default:
echo "alias composer='php ~/code/test/composer.phar'" >> ~/.bashrc
source ~/.bashrc
composer install
# Generate application key for Laravel
# https://laravel.com/docs/6.x/installation#configuration
php artisan key:generate

# See if node.js is already installed on the system first
command -v node
command -v npm

# Use Node Version Manager (nvm) to install NPM without root access
# https://ferugi.com/blog/nodejs-on-godaddy-shared-cpanel/
# https://github.com/nvm-sh/nvm
# Use nvm to install Node.js (npm, node)
cd ~
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh | bash
# Reload the PATH
source ~/.bash_profile
# Verify the installation
nvm --version


# GoDaddy instructions (may be different depending on host):
# Due to missing requirements (like GLIBCXX_3.4.14), you have to install an
# older version of node, but hopefully not too old:
# https://stackoverflow.com/a/57798787/1620794
# https://nodejs.org/en/download/releases/
# nvm install 8.17.0


# Verify node and npm are installed
node -v
npm -v
# Install Laravel packages via npm, update site CSS and JavaScript
cd ~/code
npm install
npm run production

# Update the code by pulling the latest changes
# Do the same for ~/code/test for the test site
cd ~/code
git checkout master
git pull --rebase
composer install && php artisan migrate:fresh --seed && npm install && npm run production
```

## Laravel

To start a new Laravel project, even without a Docker container ready, you can use the following
command [from the documentation](https://laravel.com/docs/8.x/installation#getting-started-on-macos):

```bash
curl -s "https://laravel.build/example-app" | bash
```

To access the app, you would go to <http://localhost>, with no port number required.

Local development uses [Laravel Sail](https://laravel.com/docs/8.x/sail#installing-sail-into-existing-applications)
with Visual Studio Code and works quite well. Laravel Sail is installed via Composer:

```bash
# Add Laravel Sail to your Laravel project
composer require laravel/sail --dev

# Actually install Laravel Sail using artisan and include the
# .devcontainer/devcontainer.json file needed for VS Code
php artisan sail:install --devcontainer

# Add a Bash/zsh alias so that you don't have to repeatedly type ./vendor/bin/sail to execute
# Sail commands (which is just a wrapper around the docker executable)
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

# Build the containers, then once they are built, you can try opening them in VS Code
sail up

# Use sail to tear down and rebuild the containers. VS Code can connect to the already-running
# detached containers.
sail down --remove-orphans --volumes && sail up --build --detach

# Run this
composer install && php artisan migrate:fresh --seed && npm install && npm run dev && php artisan route:cache
```

The MySQL database files are installed to a volume so that the database can persist even after the
container has been destroyed. You may have to destroy the volumes in order to recreate the database.
The `docker-compose.yml` file used to create the Sail Docker containers and build the MySQL database
uses the `.env` file to get the environment variables needed. The `docker-compose.yml` file has been
modified so that the name of the database will be appended with the environment name, like
`laravel_test`, `laravel_local`, or `laravel_prd` to avoid accidentally overwriting data.

This app uses a MySQL database and can be set up quickly using migrations and seeders.

```bash
# Create a model, database migration (creates tables), and seeder (adds data to tables) all at once:
# Model name here should be singular; the table will be created for you with a plural name
# automatically, neat...
php artisan make:model --controller --migration --seed -- FAQCategory

# Perform a dry-run of the migrations that will be run
php artisan migrate --pretend --seed

# To create the tables without seeding them
php artisan migrate

# To just seed the database
php artisan db:seed

# To completely refresh the database (drop all tables, recreate and seed them)
php artisan migrate:fresh --seed
```

> Note that if you change a column name and a migration fails, check routes/web.php.
> It seems that somehow, routes/web.php is executed before other code and holds on to previous
> column names.

Use this code within a Blade template to see what is currently in the session:

```php
<div class="container">
    <div class="row">
<pre>
{!! var_dump(session()->all()) !!}
</pre>
</div>
</div>
```

### Bootstrap 5

You'll need to include Bootstrap 5 in `app.scss` and `app.js` so that the CSS and JS is included
when the CSS and JS are compiled via Laravel Mix. You can use `npm run dev` in order to watch for
changes in development and quickly rebuild these assets in the `/public` folder.

```bash
npm install bootstrap
# A requirement for bootstrap
npm install @popperjs/core --save-dev
```

This has already been completed in this code; this documentation is here for reference.

### Royalty-Free Images

- [Unsplash - Karsten Wurth](https://unsplash.com/photos/rafblRbne3o)
- [Unsplash - Tachina Lee - Woman looking up](https://unsplash.com/photos/-wjk_SSqCE4)

### Iframes for YouTube Videos

This is a note to self.

Upon selecting a song, you can change the `src` property of the `<iframe>` in order to change the
loaded video, but the reason for performing a submit is so that the selected song is saved to the
session for the user. Without the form submit on change, the user's selection would not be saved
until they clicked __Save & Continue__.

There is a `data` attribute on each option of the song `<select>` element that includes the
embedeed YouTube link for preview.

### Static file caching

Laravel Mix has built-in functionality for adding hashes to prevent browsers from caching the
wrong version of static files so that the user has the up-to-date versions:

<https://laravel-mix.com/docs/6.0/versioning>

## TODOs

- Be able to set the service type using a URL parameter to the main `/guide` URL
- HIGH Priority: Look into creating routes the right way
- Look into redirecting to the beginning of the category if a route is used that doesn't belong to
  the selected service
- If you encounter issues with the routes again, look into using route parameters
  - `/guide/{guide_category}/{guide_question}`
  - `/guide/{guide_category}`
  - `/guide`
- Make sure all links work
- Add support for URL parameters to select the service type automatically
- Include all parts of service by default unless the user chose to disable them
  - Use "no" to show the user chose something, null or yes to make it checked!
- If a service is selected and the users a guide question that is not a part of that selected service,
  get the category name from that selected service and jump to the first guide question in that category.
- Find a way to add date timestamp or something to prevent javascript caching
- Finish adding all sidebar items to the database
- Finish adding all songs to the database
- Finish adding all scriptures to the database
- Create a page for the songs
- Create a page for the scriptures
- Add support for showing a YouTube link upon selecting a song via javascript (no form submit needed)
  - probably could use a `data-*` item on the selected option
- Add summary page
- Standardize all three song pages to select song type, and a song, or add their own
- Add recommendation for the first song as the opening hymn

## Jekyll

GitHub Pages utilitize [Jekyll](https://jekyllrb.com/) for static page generation
from Markdown files. There are themes that can be configured in `docs/_config.yml`.

### Local Development with Visual Studio Code

You can use Microsoft's official Docker image for Jekyll to have a complete development
environment. The configuration file for the Remote Containers extension for
VS Code for Jekyll can be found [here](https://github.com/microsoft/vscode-dev-containers/tree/main/containers/jekyll).

```bash
# This is where you cloned this repo or created a new one
cd ~/code/lastmileoftheway
mkdir -p .devcontainer

# Add devcontainer.json, Dockerfile, and post-create.sh from the /.devcontainer folder of this repo:
# https://github.com/microsoft/vscode-dev-containers/tree/main/containers/jekyll/.devcontainer
wget https://raw.githubusercontent.com/microsoft/vscode-dev-containers/main/containers/jekyll/.devcontainer/Dockerfile
wget https://raw.githubusercontent.com/microsoft/vscode-dev-containers/main/containers/jekyll/.devcontainer/devcontainer.json
wget https://raw.githubusercontent.com/microsoft/vscode-dev-containers/main/containers/jekyll/.devcontainer/post-create.sh
wget https://raw.githubusercontent.com/github/gitignore/master/Jekyll.gitignore

# Make post-create.sh executable
# The file post-create.sh installs gems specified in the Gemfile; if Gemfile.lock exists, that
# is used to install specific versions
# The version in this repo has been modified to look in /docs (if the folder exists) for the
# Gemfile
chmod +x post-create.sh

# Add a few non-secret environment variables to your Dockerfile
echo "ENV LANG=en_US.UTF-8 \\" >> Dockerfile
echo "LANGUAGE=en_US:en \\" >> Dockerfile
echo "TZ=America/New_York \\" >> Dockerfile
echo "LC_ALL=en_US.UTF-8" >> Dockerfile

# Create a /docs folder as needed for GitHub Pages; your Jekyll site will be hosted from there
mkdir -p ~/code/lastmileoftheway/docs

```

You can get GitHub's `.gitignore` for Jekyll sites [from here](https://github.com/github/gitignore/blob/master/Jekyll.gitignore).

This page is using the [Cayman theme](https://github.com/pages-themes/cayman) to start with. There,
you can see the files and folders used to create this theme. Then, you can create your own versions
that would overwrite these assets.

This unofficial [jekyll-bootstrap-theme](https://github.com/jonaharagon/jekyll-bootstrap-theme)
seems to be a good example of how to use the various folders with `sass` support. Jekyll
looks like you can basically create a site like you do with Laravel, just with no server-side code.
There are `npm` scripts that can install all Bootstrap assets for you easily:

```bash
cd /workspace/lastmileoftheway/docs/
# These scripts do not delete custom code in /docs/assets/css, so they should
# be safe to use.
npm run assets:reinstall
```

### SCSS

Please note that for `.scss` files to be processed during the `jekyll build` or
`jekyll watch` processes, you must start off your files like the following:

```sass
---
---
```

Without this at the beginning of the file, the output files of the build process are not
generated properly. The `_site` folder has the files that emerge from the build process.

To disable Jekyll static page generation to use standard HTML, add the empty
file `docs/.nojekyll`. It may take a few seconds for GitHub to notice the change
after using `git push` and show the content accordingly.

### Plugins

GitHub Pages uses plugins that are enabled by default and cannot be disabled,
as [listed in the documentation](https://docs.github.com/en/pages/setting-up-a-github-pages-site-with-jekyll/about-github-pages-and-jekyll#plugins):

- `jekyll-coffeescript`
- `jekyll-default-layout`
- `jekyll-gist`
- `jekyll-github-metadata`
- `jekyll-optional-front-matter`
- `jekyll-paginate`
- `jekyll-readme-index`
- `jekyll-titles-from-headings`
- `jekyll-relative-links`

You can enable additional plugins by adding the plugin's gem to the `plugins`
setting in your `_config.yml` file. Make sure to check which plugins are supported.

### Liquid Templating Engine

The templating engine used by Jekyll is called [Liquid](https://shopify.github.io/liquid/)
and limited but similar to that used by Django and Laravel. The available global
variables are [listed in the Jekyll documentation](https://jekyllrb.com/docs/variables/).

Jekyll also provides a number of useful Liquid additions like [some filters](https://jekyllrb.com/docs/liquid/filters/)
and [tags](https://jekyllrb.com/docs/liquid/tags/).

#### Navigation

It's possible to read from YAML files in the `_data` folder and loop through
that data to create HTML elements. We use this for `/glossary` and `/faqs`. Documentation
for how to load data to create navigation [is available here](https://jekyllrb.com/tutorials/navigation/).

### Color Palette

The fall color palette used for this website came from [coolors.co](https://coolors.co/264653-2a9d8f-e9c46a-f4a261-e76f51).

Here are the actual colors:

- <div style="background-color:#264653; color: #fff">Charcoal (#264653)</div>
- <div style="background-color:#2a9d8f; color: #fff">Persian Green (#2a9d8f)</div>
- <div style="background-color:#e9c46a; color: #000">Orange Yellow Crayola (#e9c46a)</div>
- <div style="background-color:#f4a261; color: #000">Sandy Brown (#f4a261)</div>
- <div style="background-color:#e76f51; color: #fff">Burnt Sienna (#e76f51)</div>
