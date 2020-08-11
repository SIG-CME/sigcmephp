<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property int $id_colaborador
 * @property string $usuario
 * @property string $senha
 * @property string $nivel_acesso [IGREJA, CIDADE, DISTRITO, REGIONAL]
 * @property int|null $demonstracao
 *
 * @property Colaborador $colaborador
 * @property UsuarioModulo[] $usuarioModulos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_colaborador', 'usuario', 'nivel_acesso'], 'required'],
            [['id_colaborador', 'demonstracao'], 'integer'],
            [['usuario'], 'string', 'min' => 3, 'max' => 20],
            [['senha'], 'string', 'max' => 255],
            [['senha'], 'required', 'on' => 'create'],
            [['nivel_acesso'], 'string', 'max' => 60],
            [['usuario'], 'unique'],
            [['id_colaborador'], 'exist', 'skipOnError' => true, 'targetClass' => Colaborador::className(), 'targetAttribute' => ['id_colaborador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_colaborador' => Yii::t('app', 'Colaborador'),
            'usuario' => Yii::t('app', 'Usuario'),
            'senha' => Yii::t('app', 'Senha'),
            'nivel_acesso' => Yii::t('app', 'Nivel Acesso'),
            'demonstracao' => Yii::t('app', 'Demonstração'),
        ];
    }

    /**
     * Gets query for [[Colaborador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColaborador()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'id_colaborador']);
    }

    /**
     * Gets query for [[UsuarioModulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioModulos()
    {
        return $this->hasMany(UsuarioModulo::className(), ['id_usuario' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $usuario = Usuario::findOne(['id'=> $id]);
        
        return isset($usuario) ? new static($usuario) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $usuario = Usuario::findOne(['accessToken'=> $token]);
        
        return isset($usuario) ? new static($usuario) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($usuario)
    {
        $usuario = Usuario::find()->where(['usuario' => $usuario])->one();
        
        
        return isset($usuario) ? new static($usuario) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($senha)
    {
        return $this->senha === md5($senha);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
        
            if($this->senha !== ''){
                $this->senha = md5($this->senha);
            }else{
                unset($this->senha);
            }
        
            return true;
        }
        return false;
    }
}
