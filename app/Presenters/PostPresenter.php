<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

class PostPresenter extends Nette\Application\UI\Presenter
{
    private $database;
    
    public function __construct(Nette\Database\Context $databasePar)
    {
        $this->database = $databasePar;
    }
    
    public function renderShow(int $postId)
    {
        $post = $this->database->table('posts')->get($postId);
        if(!$post)
        {
            $this->error('Stránka nebyla nalezena');
        }
        $this->template->post = $post;
        $this->template->comments = $post->related('comment')->order('created_at');
    }
    
    protected function createComponentCommentForm(): Form
    {
        $form = new Form; // means Nette\Application\UI\Form
        $form->addText('name', 'Jméno:')
                ->setRequired();
        $form->addEmail('email', 'E-mail:');
        $form->addTextArea('content', 'Komentář:')
        ->setRequired();
        $form->addSubmit('send', 'Publikovat komentář');
        $form->onSuccess[] = [$this, 'commentFormSucceeded'];
        return $form;
    }
    
    public function commentFormSucceeded(Form $form, \stdClass $values):void
    {
        $postId = $this->getParameter('postId');
        $this->database->table('comments')->insert([
            'post_id' => $postId,
            'name' => $values->name,
            'email' => $values->email,
            'content' => $values->content,
        ]);
        $this->flashMessage('Děkuji za komentář', 'success');
        $this->redirect('this');
    }
}
