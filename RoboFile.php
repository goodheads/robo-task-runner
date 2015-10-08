<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

    // define public methods as commands
    public function startServer()
    {
        $this->taskServer(8000)
            ->dir('app')
            ->arg('app/site.php')
            ->run();
    }

    public function clean()
    {
        $this->_cleanDir(['app/cache', 'app/logs']);
        $this->_deleteDir(['dist-extra/uploads']);
    }


    public function build()
    {
        // concat CSS files
        $this->taskConcat(['css/app.css','css/bootstrap.css', 'css/style.css'])
            ->to('css/all.css')
            ->run();

        // minify CSS files
        $this->taskMinify('css/all.css')
            ->to('css/all.min.css')
            ->run();

        // install Bower dependencies
        $this->taskBowerInstall()
            ->dir('vendor')
            ->run();
    }

    public function test()
    {
        // runs PHPUnit tests
        $this->taskPHPUnit()
             ->run();
    }
}