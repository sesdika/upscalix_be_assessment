const { exec } = require('child_process');
const cron = require('node-cron');

var simple_birthday_app_path = 'C:\\xampp\\htdocs\\simple-birthday-app\\index.php';

// Schedule the execution of PHP script at a specific time
cron.schedule('0 */1 * * *', () => {
  // Execute PHP script as a child process
  exec('php '+simple_birthday_app_path, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error executing PHP script: ${error.message}`);
      return;
    }
    console.log(`PHP script executed successfully. Output: ${stdout}`);
  });
}, {
  scheduled: true,
  timezone: 'Asia/Bangkok' // Replace with your desired timezone
});

console.log('PHP script scheduled to run at 9 AM.');
