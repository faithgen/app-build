<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\Template;
use InnoFlash\LaraStart\Services\CRUDServices;
use Illuminate\Database\Eloquent\Model as ParentModel;

class TemplateService extends CRUDServices
{
    private Template $template;

    public function __construct(Template $template)
    {
        if (request()->has('template_id'))
            $this->template = Template::findOrFail(request('template_id'));
        else $this->template = $template;
    }

    /**
     * Retrieves an instance of template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods
     * Its mainly the fields that you do not have in the templates table
     */
    public function getUnsetFields()
    {
        return ['template_id'];
    }

    /**
     * This returns the model found in the constructor
     * or an instance of the class if no template is found
     */
    public function getModel()
    {
        return $this->getTemplate();
    }

    /**
     * Attaches a parent to the current template
     * You can delete this if you do not intent to create templates from parent relationships
     */
    public function getParentRelationship()
    {
        return [
            ParentModel::class,
            'relationshipName',
        ];
    }
}