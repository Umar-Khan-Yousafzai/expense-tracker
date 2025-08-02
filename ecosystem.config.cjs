module.exports = {
    apps: [
      {
        name: 'scheduler',
        script: 'artisan',
        args: 'schedule:run',
        interpreter: '/usr/bin/php', // Change if PHP is elsewhere (e.g., /opt/alt/php80/usr/bin/php)
        cwd: '/home/u666385413/public_html/expense_tracker',
        watch: false,
        autorestart: true,
        max_restarts: 5,
        restart_delay: 5000,
        env: {
          NODE_ENV: 'production',
        },
      },
    ],
  };
