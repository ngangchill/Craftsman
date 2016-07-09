---
layout: main
title: Docs
---

# Overview

---

Provides a number of helpful commands for your use while developing your application.

## Features

---

Built on top of great technology.

<div class="row text-center" style="padding-top:20px;">
    <div class="col-sm-4">
      <i class="fa fa-clone fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Solid Base</h4>
      <p>Built with <a href="https://github.com/symfony/console" target="_blank">Symfony Console component</a></p>
    </div>
    <div class="col-sm-4">
      <i class="fa fa-bolt fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Generators</h4>
      <p>Generate boilerplate code for a rapid application development.</p>
    </div>     
    <div class="col-sm-4">
      <i class="fa fa-database fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Modular migrations</h4>
      <p>Manage your database scheme's evolution through independent versions.</p>
    </div>
    <div class="col-sm-4">
      <i class="fa fa-leaf fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Seed database</h4>
      <p>Easily fill your database with test data after it's created.</p>
    </div>  
    <div class="col-sm-4">
      <i class="fa fa-server fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Test environment</h4>
      <p>Test your application with ease without installing a web server.</p>
    </div>      
    <div class="col-sm-4">
      <i class="fa fa-terminal fa-3x fa-fw" aria-hidden="true"></i>
      <h4>Interactive</h4>
      <p>Every command also includes a help screen which describes available options.</p>
    </div>        
</div>

## Demo

---

<div class="embed-responsive embed-responsive-16by9">
<div class="embed-responsive-item"><script type="text/javascript" src="https://asciinema.org/a/45166.js" id="asciicast-45166" async></script></div>
</div>

## Installation

---

Before run the composer install command, add the bin-dir config path inside your ```composer.json``` file:

{% highlight JSON %}
"config": {
    "bin-dir": "bin"
}
{% endhighlight %}

#### Composer

	composer require dsv/craftsman

If you specify the bin directory you can run the command like this:

	php bin/craftsman

If you don't, this package should be listed as a vendor binary, and it should be runned like:

	php path/to/vendor/bin/craftsman

## Usage

---

To view a list of all available Craftsman commands, you may use the list command:

	php path/to/craftsman list

**Help Screen**

Every command includes a help screen which displays the command's available arguments. To view a help screen from a command, simply add the name of the command with help:

	php path/to/craftsman help migrate:latest

## Commands

---

### Generators

Craftsman provides a variety of generators to speed up your development process.

<!-- Every Generator Command comes with a `--path` argument to control where the generated file will be placed overwriting the default path.

    php path/to/craftsman generate:<command> <args> --path="path/to/new" -->

#### Controller

Generate a controller with:

    php path/to/craftsman generate:controller <name>

Output:

{% highlight PHP startinline %}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foo extends CI_Controller 
{

    /**
     * Display a listing of the resource.
     * GET /Foo
     */
    public function index()
    {
        
    }

    /**
     * Display the specified resource.
     * GET /Foo/get/{id}
     *
     * @param  int  $id
     */
    public function get($id)
    {

    }   

    /**
     * Show the form for creating a new resource.
     * GET /Foo/create
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * POST /Foo/store
     */ 
    public function store()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * GET /Foo/edit/{id}
     *
     * @param  int  $id
     */
    public function edit($id)
    {

    }   

    /**
     * Update the specified resource in storage.
     * PUT /Foo/update/{id}
     *
     * @param  int  $id
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /Foo/delete/{id}
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        
    }
}

/* End of file Foo.php */
/* Location: /path/to/application/controllers/Foo.php */  
?>{% endhighlight %} 

#### Model

Generate a model with:

    php path/to/craftsman generate:model <name>

Output:

{% highlight PHP startinline %}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foo_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();    
    }
}

/* End of file Foo_model.php */
/* Location: /path/to/application/models/Foo_model.php */
?>
{% endhighlight %}

#### Migration

Generate a migration with:

    php path/to/craftsman generate:migration <name>

Regardless of which numbering style you choose to use, the generator command will prefix your migration files with the migration number. For example:

* 001_add_blog.php (sequential numbering)
* 20121031100537_add_blog.php (timestamp numbering)    

If the migration name is prefixed by `create_` or `modify_` and is followed by a list of column names and types, then a migration containing the appropriate `add_column` and `update_column` statements will be created.

**Example**

    php path/to/craftsman generate:migration create_users firstname:varchar lastname:varchar email:varchar active:smallint

Output:

{% highlight PHP startinline %}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_create_users extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() 
    {
        $this->create_users_table();
    }

    public function down() 
    {
        $this->dbforge->drop_table('ci_users');
    }

    private function create_users_table()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'active' => array(
                'type' => 'SMALLINT',
                'null' => FALSE,
                'default' => 1
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('ci_users',TRUE);      
    }
}

/* End of file 001_create_users.php.php */
/* Location: path/to/application/migrations/001_create_users.php */
?>{% endhighlight %}

Now it's your turn to give the finishing touches before running this scheme. Check the [Database Forge documentation](https://codeigniter.com/user_guide/database/forge.html) for more information about CodeIgniter Migrations.

### Migrations

Migration schemes are simple files that hold the commands to apply and remove changes to your database. It allows you to easily keep track of changes made in your app. They may create/modify tables or fields, etc. But they are not limited to just changing the schema. You could use them to fix bad data in the database or populate new fields.

**Database Settings** 

If you're going to use `Migration Commands` you should configure your `application/config/database.php` settings needed to access to your database.

#### File names

Each Migration is run in numeric order forward or backwards depending on the method taken. Two numbering styles are available:

* **Sequential**: each migration is numbered in sequence, starting with 001. Each number must be three digits, and there must not be any gaps in the sequence. (This was the numbering scheme prior to CodeIgniter 3.0.)
* **Timestamp**: each migration is numbered using the timestamp when the migration was created, in `YYYYMMDDHHIISS` format (e.g. 20121031100537). This helps prevent numbering conflicts when working in a team environment, and is the preferred scheme in CodeIgniter 3.0 and later.

**Timestamp Style**

By default Craftsman uses the sequential style but it can be changed using the `--timestamp` argument.

#### Displaying info

You can display the current migration status with the comand:

	php path/to/craftsman migrate:check

Output:

    ---------------- --------------------------------------------------------------- 
     Migration        Value                                                          
    ---------------- --------------------------------------------------------------- 
     Name             ci_system  
     Type             secuential                                                    
     Path             /path/to/application/migrations/  
    ---------------- ---------------------------------------------------------------
     Actual version   1                                                              
     Latest version   1                                                
    ---------------- ---------------------------------------------------------------   

    [OK] Database is up-to-date.

Where:

* **Name**: migration name version.
* **Actual version**: version actually stored in your database.
* **Latest version**: latest migration file version founded in the migration directory.
* **Path** is the migration directory where all your migrations are stored.
* **Type**: the migration version type.

Below the information table, there is a legend witch indicates the action to take. If a database update is available, the legend displays the following message: 

    ! [NOTE] The Database is not up-to-date with the latest changes, run:'migrate:latest' to update them.

#### Running migrations

Migrations are designed to be mostly automatic, but you’ll need to know when to make migrations, when to run them, and the common problems you might run into. Here's a list of possible options.

Each migration command shows relevant information about the db scheme changes using the `--debug` argument.

**Latest**

Migrate to the latest version, the migration class will use the very newest migration found in the filesystem.

	php path/to/craftsman migrate:latest

**Version**

Version can be used to roll back changes or step forwards programmatically to specific versions.

	php path/to/craftsman migrate:version <number>

#### Rolling-back migrations

Allows you to quickly roll back and forth through the history of the migration schema, so as to work with desired version. Here's a list of possible options.

**Rollback the last migration operation**

	php path/to/craftsman migrate:rollback

**Rollback all migrations**

	php path/to/craftsman migrate:reset

**Rollback all migrations and run them all again**

	php path/to/craftsman migrate:refresh


### Seeders

Craftsman comes with a simple method of seeding your database with test data using seed classes. All seed classes are stored by default in your `path/to/application/seeders` folder. Seed classes may have any name you wish, but probably should follow the [CodeIgniter Style Guide](https://codeigniter.com/userguide3/general/styleguide.html).

To generate a seeder:

    php path/to/craftsman generate:seeder <name>

A seeder class only contains the `run()` method by default. This method is called when the `db:seed` command is executed. Within the run method, you may insert data into your database however you wish. You may use the [Query Builder Class
](https://codeigniter.com/user_guide/query_builder.html) to manually insert data.

**Example**

Add a database insert statement to the run method:

{% highlight PHP startinline %}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Craftsman\Classes\Seeder;

class Foo extends Seeder implements \Craftsman\Interfaces\Seeder
{
    private $table = 'ci_foo';

    public function run()
    {   
        $this->db->insert($this->table, [
            'title' => 'Title 1',
            'name'  => 'Name 1',
            'date'  => date('Y-m-d H:i:s')
        ]);
    }
}

/* End of file Foo.php */
/* Location: /path/to/application/seeders/Foo.php */ 
?>{% endhighlight %} 


One you have written your seeder class, you may use the command`:

    php path/to/craftsman db:seed <name>

## Advanced

---

### Modular Migrations

If you're familiar with the [Codeigniter Migration Class](https://codeigniter.com/user_guide/libraries/migration.html), it is imposible to maintain separated migration files in your application, you need to merge these files in one directory and fix the `migration file name`.

With Craftsman you can manage your database scheme's evolution through independent versions of your components.

We will assume the following directory stucture:

    +- APPPATH/
    | +- migrations/
    | | +- 001_add_blog.php
    | | +- 002_add_posts.php

And an application library uses a database scheme (like Ion Auth, Community Auth, etc). This migrations reside in:

    +- APPPATH
    | +- libraries/
    | | +- fooLib/
    | | | +- migrations
    | | | | +- 001_add_session.php
    | | | | +- 002_add_other_stuff.php

Run the Migration command with the `--path` argument:

    php vendor/bin/craftsman migrate:latest --path="application/libraries/fooLib"

And your migrations are now independent. 

In your database you can see that every component have an assigned version:

    mysql> SELECT * FROM ci_migrations; 

    +---------------+---------+
    | module        | version |
    +---------------+---------+
    | ci_system     |       2 |
    | foolib        |       2 |
    +---------------+---------+

Also you can change the component stored name in the database with the `--name` argument:

    php vendor/bin/craftsman migrate:latest --name="foo" --path="application/libraries/fooLib"

## Contributions

---

The Craftsman project welcomes, and depends on contributions from developers and users in the CodeIgniter open source community. Contributions can be made in a number of ways, a few examples are:

* Code patches via pull requests
* Documentation improvements
* Bug reports and patch reviews

**Reporting an Issue?**

Please include as much detail as you can. Let us know your platform and `Craftsman/CodeIgniter` version. If the problem is visual (for example a theme or design issue) please add a screenshot and if you get an error please include the the full error and traceback.

**Submitting Pull Requests**

Once you are happy with your changes or you are ready for some feedback, push it to your fork and send a pull request. For a change to be accepted it will most likely need to have tests and documentation if it is a new feature.