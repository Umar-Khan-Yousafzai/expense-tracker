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
        max_restarts: 10, // Increase to allow more restarts for debugging
        restart_delay: 5000,
        env: {
          APP_ENV: 'production',
        },
        error_file: '/home/u666385413/.pm2/logs/scheduler-error.log',
        out_file: '/home/u666385413/.pm2/logs/scheduler-out.log',
        log_date_format: 'YYYY-MM-DD HH:mm:ss',
      },
    ],
  };
