<?php
namespace Craftsman\Commands\Generators;

use Craftsman\Classes\Generator;

/**
 * Generator\Seeder Command
 *
 * @package     Craftsman
 * @author      David Sosa Valdes
 * @link        https://github.com/davidsosavaldes/Craftsman
 * @copyright   Copyright (c) 2016, David Sosa Valdes.
 */
class Seeder extends Generator implements \Craftsman\Interfaces\Command
{
	protected $name        = 'generator:seeder';
	protected $description = 'Generate a Seeder';

	public function start()
	{
        $filename = ucfirst($this->getArgument('filename'));
        $basepath = rtrim($this->getOption('path'),'/').'/seeders/';

		$this->text('Seeder path: <comment>'.$basepath.'</comment>');
		$this->text('Filename: <comment>'.$filename.'.php</comment>');			

        // Confirm the action
	    if($this->confirm('Do you want to create a '.$filename.' Seeder?', TRUE))
	    {
			// We could try to create a directory if doesn't exist.
			(! $this->_filesystem->exists($basepath)) && $this->_filesystem->mkdir($basepath);	    	
	    
	    	$test_file = $basepath.$filename.'.php';

	    	$options = array(
	    		'NAME' => $filename,
	    		'COLLECTION' => $filename,
	    		'FILENAME'   => basename($test_file),
	    		'PATH'       => $test_file	    		
	    	);
	    	if ($this->make($test_file, CRAFTSMANPATH.'src/Templates/Seeders', $options)) 
	    	{
	    		$this->success('Model created successfully!');
	    	}
	    }
	    else
	    {
	    	$this->warning('Process aborted!');
	    }
	}
}