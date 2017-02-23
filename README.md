# Firebird Classic


Dillinger is a package for firebird laravel >=5.1 using ibase function and that not using pdo because numeric in pdo firebird return random number.

#### feature
  - excute query
  - insert
  - update
  - delete

### Installation
composer require "laravelcollective/html":"^0.0.2"
#### or add manual in composer.json
```"require": {
        .....
        "firebird-classic" : "^0.0.2",
        ......
 },

Next, add your new provider to the providers array of config/app.php:
```'providers' => [
    // ...
    FireBirdClassic\FirebirdClassicServiceProvider::class,
    // ...
  ],
  
  ### How to use it
  
  first you must add IbaseQuery namespace
  use FireBirdClassic\Query\IbaseQuery;
  than create constructor  :
  
  public function __construct()
    {
        $this->command = new IbaseQuery;
    }
    
#### feature ibase query

##### a. execute for excute query

$this->command->execute($query);

example: 
$query = "SELECT * FROM USER";
$this->command->execute($query);

##### b. create 
$this->command->create($table,$data);
example : 
$data = ['USERNAME'=>'Sarah',['PASSWORD']=>'yourname'];
$this->command->create('USER',$data);

##### b. update 
$this->command->update($>table, $data, $condition)
example :
$data = ['USERNAME'=>'Sarah',['PASSWORD']=>'yourname'];
$condition = ['ID'=>1];
$this->command->update('USER',$data);

##### c. delete
$this->command->delete($table, $condition);
example:
$condition = ['ID'=>1];
$this->command->update('USER',$condition);

##note :
$data and $codition is array.
for execute sql create,update and delete you must run function execute.
example :
$command = $this->command->create('USER',$data);
$this->command->execute($command);





  
  
