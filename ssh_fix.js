import { Client } from 'ssh2';

const conn = new Client();
conn.on('ready', () => {
  console.log('Client :: ready');
  conn.exec('ls -la /home/u871147009/domains/portafolio.pdsx.org/public_html', (err, stream) => {
    if (err) throw err;
    stream.on('close', (code, signal) => {
      console.log('Stream :: close :: code: ' + code + ', signal: ' + signal);
      conn.end();
    }).on('data', (data) => {
      console.log('STDOUT: ' + data);
    }).stderr.on('data', (data) => {
      console.log('STDERR: ' + data);
    });
  });
}).on('error', (err) => {
  console.error('Error:', err);
}).connect({
  host: '5.183.10.162',
  port: 65002,
  username: 'u871147009',
  password: 'PASSWORDN!i@ggMU2AtBAZ9'
});
