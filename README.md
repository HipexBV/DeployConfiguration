# Hipex Deploy Configuration
These documentation is the guide to painlessly setup an automated deploy on the [Hipex B.V.](https://www.hipex.io/)
 platform.
The repository contains:

- Configuration objects
- Documentation

The deploy image is based on https://deployer.org/ and is 100% compatible with its recipe's and functions. Hipex uses
configuration objects to provide some form of autocompleteion. These configuration objects can be found in this
repository. The hipex wrapper will use the configuration set to create a set of deploy recipe's and hosts that
can be overwritten / extended by the projects `deploy.php`.

## Whats inside?
- Deployer configuration hosts / tasks
- Hipex server setup
- Email / New Relic notification
- CloudFlare flush

## Configuration
1. Composer `require hipex/deploy-configuration --dev` package. Only needed when you want to have autocomplete in your `deploy.php`
file.
2. Copy the deploy templates inside the root of your project as `deploy.php`. You can find the template in
[templates/deploy.php](./templates/deploy.php).
3. Setup your CI server
    1.  GitLab CI [templates/.gitlab-ci.yml](./templates/.gitlab-ci.yml).
    3.  Bitbucket [templates/bitbucket-pipelines.yml](./templates/bitbucket-pipelines.yml).
4. Your first build will fail due to missing configuration. Login to the server and depending on your project file edit
the `app/etc/env.php` or `app/etc/local.xml`. You will find these files in `~/domains/<domain>/application/shared/`.  

## Build steps
1. `build:update` Checkout the code and run composer installer
2. `build:compile` Run frontend build and compilation tasks and other `Configuration::getBuildCommands` commands
3. `build:package` Package code into `tgz` archive
4. `deploy:prepare_release` Prepare deployment folders on the server(s)
5. `deploy:copy` Copy build files to server(s)
6. `deploy:deploy` Run database migrations and other `Configuration::getDeployCommands` commands
7. `deploy:link` Set symlinks to new version
8. `deploy:after` Flush caches and send notification and other `Configuration::getAfterDeployCommands` commands

All these steps are regular deployer tasks so the can be extended or even overwritten per project.

## Required environment variables
Some specific environment variables are required to allow the deploy image access to the git repository
or to be able to send out notifications.

### Required
- `SSH_PRIVATE_KEY` Unencrypted SSH key. The key needs to have access to: main git repository, private packages
and the SSH user. Must be base64 encoded like this:

```bash
cat ~/.ssh/deploy_key | base64
```

### Composer authentication
These variables are only required if Magento composer repository authentication is not configured using `auth.json`. 
- `DEPLOY_COMPOSER_AUTH` base64 encoded content of `auth.json`. Can be fetched using `cat auth.json | base64`.

### Optional
Email notifications
- `SMTP_SERVER`
- `SMTP_USER` 
- `SMTP_PASS`
- `NOTIFICATION_EMAIL_TO` Comma separated list of email address to send notification to
- `NOTIFICATION_EMAIL_FROM`

NewRelic deploy mark (https://deployer.org/recipes/newrelic)
- `NEWRELIC_APP_ID`
- `NEWRELIC_API_KEY`

Slack (https://deployer.org/recipes/slack)
- `SLACK_WEBHOOK`

Cloudflare
- `CLOUDFLARE_SERVICE_KEY`

## Testing
To test your build & deploy you can run your deploy locally.

First make sure you have all the required env variables setup using.

```bash
export SSH_PRIVATE_KEY=***
export DEPLOY_COMPOSER_AUTH=***
.... etc
```

Then start your build / deployment run command from root of the project.

*repeat -e <ENV> for all env vars that are present during build*
```bash
docker run -it -e SSH_PRIVATE_KEY -e DEPLOY_COMPOSER_AUTH -v `pwd`:/build hipex/deploy hipex-deploy build -vvv 
```

```bash
docker run -it -e SSH_PRIVATE_KEY -e DEPLOY_COMPOSER_AUTH -v `pwd`:/build hipex/deploy hipex-deploy deploy acceptance -vvv 
```

## Deployer variables
Deployer exposes allot of variables you can fetch using the `\Deployer\get` or any other deployer method. Please see
https://deployer.org/docs/configuration for a more detailed explenation. On top of the default variables exposed by 
deployer the Hipex image adds the following:

- `bin/php` PHP binary location
- `public_folder` Public html folder of the project.
- `domain_path` Root domain folder (`/home/<user>/domains/<domain>`)
- `deploy_path` Root deploy folder containing releases, shared files etc: (`/home/<user>/domains/<domain>/application`)
- `cpu_cores` Number of CPU cores on the system
- `release_message` Markdown formatted release message, including branch, commit and merged branches. 
- `commit_sha` Commit sha1 reference

## Commonly used commands

### \HipexDeployConfiguration\Command\Deploy\NginxConfiguration
Synchronise nginx configuration from repository to server

Arguments:
- `sourceFolder` Relative path to the nginx configuration in project. (default `etc/nginx/`)

### \HipexDeployConfiguration\Command\Deploy\CronConfiguration
Replaces crontab with cron file from git. Will prepend some extra env variables to use in cronjobs:

- `PATH`, bash configured `PATH` variable at deploy time.
- `APP_ROOT` Root of the current release `{{release_path}}`

Arguments:
- `sourceFifle` Relative path to the crontab file. (default `etc/cron`) 

### \HipexDeployConfiguration\Command\Deploy\Magento2\JobqueueConsumer
Create a supervisord managed jobqueue consumer on server with role `ServerRole::APPLICATION_FIRST`.

Arguments:
- `consumer` Name of the consumer for example `async.operations.all`
- `workers` Number of consumers to run  (default `1`)


### \HipexDeployConfiguration\Command\Deploy\VarnishConfiguration
Create a varnish instance managed by supervisord on server with role `ServerRole::VARNISH`.

Arguments:
- `memory` Memory usage (default `1024m`)
- `frontendPort` Default varnish frontend port (default `6181`)
- `adminPort` Default varnish admin port (default `6182`)
- `configFile` Varnish configuration file (default `etc/varnish.vcl`)
- `arguments` Extra arguments used to start varnish


### \HipexDeployConfiguration\Command\Deploy\RedisConfiguration
Create a redis instance managed by supervisord on server with role `ServerRole::REDIS`.

Arguments:
- `maxMemory` Max memory usage (default `1024m`)
- `listen` Listen to unix socket or ip:port (default `{{domain_path}}var/run/redis.sock`)
- `master` Redis instance is slave of configuration
- `configuration` Key value pairs with extra configuration for redis config


### \HipexDeployConfiguration\Command\Deploy\SupervisorConfiguration
Create supervisor service configuration for long running process like varnish or PWA nodejs service.

Arguments:
- `name` Name of the service
- `supervisorCommand` The command to run
- `workers` Number of workers (default `1`)
- `configuration` Array of extra key value pairs with configuration settings for supervisor
