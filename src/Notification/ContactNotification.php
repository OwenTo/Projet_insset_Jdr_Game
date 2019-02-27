<?php
/**
 * Created by PhpStorm.
 * User: figof
 * Date: 15/11/2018
 * Time: 15:23
 */

namespace App\Notification;


use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{

    /**
     * @var \Swift_Mailer
     */
    private $mailler;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailler, Environment $renderer)
    {
        $this->mailler = $mailler;
        $this->renderer = $renderer;
    }

    public function  notify(Contact $contact){
        $message=(new \Swift_Message("Demande de :".$contact->getNameContact())) ;
        $message->setFrom($contact->getEmailContact());
        $message->setTo('baldini.dylan@gmail.com');
        $message->setReplyTo($contact->getEmailContact());
        $message->setBody($this->renderer->render('contact/emails/contact.html.twig',[
            'contact'=>$contact
        ]),'text/html');
        $this->mailler->send($message);


    }

}