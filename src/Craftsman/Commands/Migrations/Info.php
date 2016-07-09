<?php
namespace Craftsman\Commands\Migrations;

use Craftsman\Classes\Migration;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Migration\Info Command
 *
 * @package     Craftsman
 * @author      David Sosa Valdes
 * @link        https://github.com/davidsosavaldes/Craftsman
 * @copyright   Copyright (c) 2016, David Sosa Valdes.
 */
class Info extends Migration implements \Craftsman\Interfaces\Command
{
	protected $name        = 'migrate:check';
	protected $description = 'Display the current migration scheme status';
	protected $harmless    = TRUE;

	public function start()
	{
		$migrations     = $this->migration->find_migrations();
		$db_version     = $this->migration->get_db_version();
		$latest_version = $this->migration->get_latest_version($migrations);

		$this->table(
			array('Migration','Value'),
			array(
				array('Name', $this->migration->get_module_name()),
				array('Type', $this->migration->get_type()),
				array('Path',$this->migration->get_module_path()),
				new TableSeparator(),
				array('Actual version', $db_version),
				array('Latest version', $latest_version),
			)
		);

		if ($latest_version < $db_version) 
		{
			$this->caution('Could not find any migrations, check the migration path.');
		}
		elseif ($latest_version > $db_version) 
		{
			$this->note(
				'The Database is not up-to-date with the latest changes, '
				."run 'migrate:latest' to update them."
			);
		}
		else
		{
			$this->success('Database is up-to-date.');
		}
	}
}