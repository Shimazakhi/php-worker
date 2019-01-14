<?php

namespace HyveMobileTest\Lib;



use HyveMobileTest\Models\Contact;

class ContactCardGenerator
{
    const BASEPATH = '/var/www/projects/hyvetest/';

    protected $contact;

    protected $image;

    protected $textLines = [];

    protected $path;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;

        $this->defineExportPath();

        $this->image = $this->buildBackground();

        $this->textLines[] = $this->buildNameTextLine();

        $this->textLines[] = $this->buildEmailTextLine();
    }

    public function generate()
    {
        $this->alignLayers();

        $this->image->render($this->path);

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    private function alignLayers()
    {
        foreach ($this->textLines as $textLine) {
            $this->image->addText($textLine);
        }
    }

    private function defineExportPath()
    {
        $this->path = self::BASEPATH.'storage/contacts/'.$this->contact->email.'.jpg';
    }

    private function buildBackground()
    {
        return new \NMC\ImageWithText\Image(self::BASEPATH.'resources/images/source.jpg');
    }

    private function buildNameTextLine()
    {
        $text = new \NMC\ImageWithText\Text($this->generateNameLineText(), 1, 25);
        $text->align = 'left';
        $text->color = 'FFFFFF';
        $text->font = self::BASEPATH.'resources/fonts/Pacifico.ttf';
        $text->lineHeight = 25;
        $text->size = 15;
        $text->startX = 10;
        $text->startY = 10;

        return $text;
    }

    private function buildEmailTextLine()
    {
        $text = new \NMC\ImageWithText\Text($this->contact->email.' ', 1, 35);
        $text->align = 'left';
        $text->color = 'FFFFFF';
        $text->font = self::BASEPATH.'resources/fonts/Ubuntu-Medium.ttf';
        $text->lineHeight = 25;
        $text->size = 11;
        $text->startX = 10;
        $text->startY = 40;

        return $text;
    }

    private function generateNameLineText()
    {
        return $this->contact->first_name.' '.$this->contact->last_name;
    }
}
