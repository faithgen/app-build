<?php

namespace Faithgen\AppBuild\Observers;

use Faithgen\AppBuild\Models\Template;
use FaithGen\SDK\Traits\FileTraits;

class TemplateObserver
{
    use FileTraits;

    /**
     * Handle the template "created" event.
     *
     * @param Template $template
     * @return void
     */
    public function created(Template $template)
    {
        //
    }

    /**
     * Handle the template "updated" event.
     *
     * @param Template $template
     * @return void
     */
    public function updated(Template $template)
    {
        //
    }

    /**
     * Handle the template "deleted" event.
     *
     * @param Template $template
     * @return void
     */
    public function deleted(Template $template)
    {
        if ($template->images) {
            $this->deleteFiles($template);
        }
    }
}
