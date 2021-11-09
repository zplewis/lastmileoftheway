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
