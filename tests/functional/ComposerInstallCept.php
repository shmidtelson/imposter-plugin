<?php use TypistTech\Imposter\Plugin\FunctionalTester;

$I = new FunctionalTester($scenario);
$I->wantToTest('vendor files transformed during install');

$I->runComposerInstall();

$I->seeInShellOutput(PHP_EOL . PHP_EOL . 'Running Imposter');

$I->assertTransformed('vendor/dummy/dummy/DummyClass.php');
$I->assertTransformed('vendor/dummy/dummy-psr4/src/DummyOne.php');
$I->assertTransformed('vendor/dummy/dummy-psr4/src/DummyTwo.php');
$I->assertTransformed('vendor/dummy/dummy-psr4/src/Sub/DummyOne.php');

$I->wantTo('check classmap added');
$I->openFile('vendor/composer/autoload_classmap.php');
$I->seeInThisFile('MyPlugin\\\\Vendor\\\\Dummy\\\\File\\\\DummyClass');
$I->seeInThisFile('MyPlugin\\\\Vendor\\\\Dummy\\\\Psr4\\\\DummyOne');
$I->seeInThisFile('MyPlugin\\\\Vendor\\\\Dummy\\\\Psr4\\\\DummyTwo');
$I->seeInThisFile('MyPlugin\\\\Vendor\\\\Dummy\\\\Psr4\\\\Sub\\\\DummyOne');

$I->seeInShellOutput(PHP_EOL . 'Success: Imposter transformed vendor files.' . PHP_EOL . PHP_EOL);
