<?php
namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents Reg Page
 */
class SignupPage extends BasePage
{
    public $route = 'site/signup';

    /**
     * Method representing user submitting signup form.
     *
     * @param array $signupData
     */
    public function submit(array $signupData)
    {
        foreach ($signupData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="Signup[' . $field . ']"]', $value);
        }
        
        $this->actor->click('signup-button');
    }
}
