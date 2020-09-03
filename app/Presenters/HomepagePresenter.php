<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $database;
    public function __construct(Nette\Database\Context $databasePar)
    {
        $this->database = $databasePar; 
    }
    public function renderDefault()
    {
        $this->template->posts = $this->database->table('posts')
                ->limit(5);
    }
}
?>