<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\Template;
use InnoFlash\LaraStart\Services\CRUDServices;

class TemplateService extends CRUDServices
{
    protected Template $template;

    public function __construct()
    {
        $this->template = app(Template::class);

        $templateId = request()->route('template') ?? request('template_id');

        if ($templateId) {
            $this->template = $this->template->resolveRouteBinding($templateId);
        }
    }

    /**
     * Retrieves an instance of template.
     *
     * @return \Faithgen\AppBuild\Models\Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods.
     * Its mainly the fields that you do not have in the messages table.
     *
     * @return array
     */
    public function getUnsetFields(): array
    {
        return ['template_id'];
    }
}
