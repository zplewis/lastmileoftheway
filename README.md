# lastmileoftheway

Website for creating custom funeral or memorial liturgies (orders of service).

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
