<?php 
namespace Craftsman\Commands\General;

use Craftsman\Commands\Base as Command;

use Symfony\Component\Process\ProcessUtils;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;

class Serve extends Command 
{
  protected $name = 'serve';
  protected $description = 'Serve the application on the PHP development server';

  /**
   * Command configuration method.
   * Configure all the arguments and options.
   */
  protected function configure()
  {
    parent::configure();

    $this       
        ->addOption(
            'host',
            NULL,
            InputOption::VALUE_OPTIONAL,
            'The host address to serve the application on.',
            'localhost'
        )
        ->addOption(
            'port',
            NULL,
            InputOption::VALUE_OPTIONAL,
            'The port to serve the application on.',
            8000
        )
        ->addOption(
            'docroot',
            NULL,
            InputOption::VALUE_OPTIONAL,
            'Specify an explicit document root.',
            FALSE
        );               
  }  

  /**
   * Execute the console command.
   *
   * @return void
   * @throws \Exception
   */
  public function start() 
  {
    $host    = $this->getOption('host');
    $port    = intval($this->getOption('port'));
    $base    = ProcessUtils::escapeArgument(__DIR__);
    $binary  = ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false));
    $docroot = ProcessUtils::escapeArgument($this->getOption('docroot')? $this->getOption('docroot'): '.');

    $this->text("Codeigniter development server started on http://{$host}:{$port}/");

    if (defined('HHVM_VERSION')) 
    {
      if (version_compare(HHVM_VERSION, '3.8.0') >= 0) 
      {
        passthru("{$binary} -m server -v Server.Type=proxygen -v Server.SourceRoot={$base}/Extra/ -v Server.IncludeSearchPaths.docroot={$docroot} -v Server.IP={$host} -v Server.Port={$port} -v Server.DefaultDocument=server.php -v Server.ErrorDocument404=server.php");
      }
      else 
      {
        throw new \Exception("HHVM's built-in server requires HHVM >= 3.8.0.");
      }
    }
    else 
    {
      passthru("{$binary} -S {$host}:{$port} -t {$docroot} {$base}/Extra/server.php");
    }
  }
}
