<?php

namespace core\services;

use core\entities\About;
use core\forms\AboutFrom;
use core\repositories\AboutRepository;

class AboutService
{
    private $abouts;

    public function __construct(AboutRepository $abouts)
    {
        $this->abouts = $abouts;
    }

    public function create(AboutFrom $form)
    {
        $about = About::create(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->abouts->save($about);
        return $about;
    }

    public function edit($id, AboutFrom $form)
    {
        $about = $this->abouts->get($id);
        $about->edit(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->abouts->save($about);
        return $about;
    }

    public function remove($id)
    {
        $about = $this->abouts->get($id);
        $this->abouts->remove($about);
    }
}