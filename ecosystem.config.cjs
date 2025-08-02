module.exports = {
    apps: [
      {
        name: 'scheduler',
        script: 'artisan',
        args: 'schedule:work',
        interpreter: '/usr/bin/php',
        cwd: '/home/u666385413/public_html/expense_tracker',
        watch: false,
        autorestart: true,
        max_restarts: 5,
        restart_delay: 5000,
        env: {
          APP_ENV: 'production',
        },
      },
    ],
  };
