<?php

namespace frontend\controllers;

use frontend\models\Cliente;
use frontend\models\ClienteInfo;
use frontend\models\Pessoa;
use Yii;
use yii\base\DynamicModel;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class MensalController extends \yii\web\Controller
{
    public function actionCadastrarb()
    {

        $model = new Cliente();

        $model_pessoa = Pessoa::findall();


        if($model_pessoa)
            $model_pessoa = ArrayHelper::map($model_pessoa, 'cpf', 'cpf');


        if ($model->load(\Yii::$app->request->post())) {
//            Carregando load

            try {
                if ($model->cadastrar()) {
                    return $this->redirect(['mensal/cliente', 'cpf' => $model->getCpfCliente()]);
                }
            } catch (\Exception $e) {
                var_dump($e->getMessage());

            }
            exit();
        }
        return $this->render('cliente/__cadastrar', ['model' => $model, 'model_pessoa' => $model_pessoa]);
    }

    public function actionCadastrar()
    {

        $model = new ClienteInfo();

        if (\Yii::$app->request->post()) {

            $post = \Yii::$app->request->post()['ClienteInfo'];

            $model->setCpfCliente($post['cpf_cliente']);
            $model->setCnh($post['cnh']);
            $model->setEmail($post['email']);
            $model->setNome($post['nome']);
            $model->setSexo($post['sexo']);
            $model->setDataNascimento($post['data_nascimento']);
            $model->setRg($post['rg']);
            $model->setTelefone($post['telefone']);

//            Carregando load
            try {
                if ($model->cadastrar()) {
                    return $this->redirect(['mensal/cliente', 'cpf' => $model->getCpfCliente()]);
                }
            } catch (\Exception $e) {

            }
        }
        return $this->render('cliente/cadastrar', ['model' => $model]);
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCliente($cpf)
    {

        $model = Cliente::findcliente_info($cpf);

        if ($model) {
            return $this->render('cliente', ['model' => $model]);
        }
        Yii::$app->session->setFlash('warning', 'CPF não localizado');
        return $this->redirect(['mensal/index']);
    }

    public function actionLista()
    {


//      Procura no banco todos os clientes retornando um array
        $model = Cliente::findall();

//      Criação do provider para uso no grid view

        if ($model) {

            $provider = new ArrayDataProvider([
                'allModels' => $model,
                'sort' => [
//                    'attributes' => ['cpf_cliente', 'nome', 'telefone'],
                ],
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
        }
        else
            $provider = null;
        return $this->render('cliente/lista', ['dataProvider' => $provider]);
    }

    public function actionClienteDelete($cpf)
    {
        $model_cliente = Cliente::findcliente($cpf);


        $model_pessoa = Pessoa::findpessoa($model_cliente->getCpfCliente());

        $model_pessoa->setAtivo(Cliente::DESATIVADO);
//        $model->setAtivo(Cliente::DESATIVADO);

        try {
            $model_pessoa->atualizar();
            return $this->redirect(['mensal/cliente', 'cpf' => $model_pessoa->getCpf()]);
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            Yii::$app->session->setFlash('error', $e->getMessage());

            return $this->goBack();
        }
    }

    public function actionClienteBuscar()
    {

        $model_dynamic = new \yii\base\DynamicModel([
            'cpf',
            'nome'
        ]);

        $post = Yii::$app->request->post();
        if ($post) {

            $post = $post['DynamicModel'];

//            var_dump(Yii::$app->request->ge)

            if (!empty($post['cpf'])) {
                $model = Cliente::buscartodosclienteporcpf($post['cpf']);
            } else {
                $model = Cliente::buscartodosclientepornome($post['nome']);
            }



//      Encontrou pelo menos 1 elemento
            if ($model) {
                //      Criação do provider para uso no grid view
                $provider = new ArrayDataProvider([
                    'allModels' => $model,
//                    'sort' => [
//                        'attributes' => ['cpf_cliente', 'nome'],
//                    ],
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]);
                return $this->render('cliente/buscar',
                    ['dataprovider' => $provider, 'model_dynamic' => $model_dynamic]);
            }


            Yii::$app->session->setFlash('warning', 'Nenhum cliente localizado com os dados informado');
        }


        return $this->render('cliente/buscar', ['model_dynamic' => $model_dynamic]);
    }

    public function actionAdicionarVeiculo($cpf)
    {
        var_dump($cpf);
        exit;
    }
}
