<?php
/**
 * Created by Eton Digital.
 * User: Milos Milojevic (milos.milojevic@etondigital.com)
 * Date: 6/2/15
 * Time: 12:04 PM
 */

namespace ED\BlogBundle\Interfaces\Model;


interface CommentInterface
{
    public function setComment($comment);

    public function getComment();

    public function setName($name);

    public function getName();

    public function setArticle(ArticleInterface $article);

    public function getArticle();

    public function setParent(CommentInterface $comment);

    public function getParent();

    public function setStatus($status);

    public function getStatus();

    public function setEmail($email);

    public function getEmail();

    public function setCreatedAt($createdAt);

    public function getCreatedAt();

    public function setModifiedAt(\DateTime $modifiedAt);

    public function getModifiedAt();

    public function setAuthor(ArticleCommenterInterface $author);

    public function getAuthor();
}