<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $email;
    public $icon;
    public $files;
    public $password;
    public $company_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['name', 'surname', 'email'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['name', 'surname', 'password'], 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['company_id', 'integer', 'min' => 1],
            ['icon', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ['files', 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xlsx, doc, docx', 'maxFiles' => 4],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        Yii::$app->params['uploadPath'] = Yii::getAlias("@frontend") . '/web/uploads/';
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->name = $this->name;
        $user->company_id = $this->company_id;
        $user->file = UploadedFile::getInstances($this::className(), 'icon');
        $user->officeFiles = UploadedFile::getInstances($this::className(), 'files');
        if ($user->upload()) {
            // file is uploaded successfully
            echo "File successfully uploaded";
        }
        if ($user->uploadFiles()) {
            // file is uploaded successfully
            echo "Files successfully uploaded";
        }
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
