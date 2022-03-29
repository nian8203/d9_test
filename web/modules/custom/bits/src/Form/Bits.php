<?php  
  
/**  
 * @file  
 * Contains Drupal\welcome\Form\MessagesForm.  
 */  
  
namespace Drupal\bits\Form;  
  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class Bits extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'bits.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'bits_form';  
  }  


  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('bits.adminsettings');  
  
    // $form['welcome_message'] = [  
    //   '#type' => 'textarea',  
    //   '#title' => $this->t('Welcome message'),  
    //   '#description' => $this->t('Welcome message display to users when they login'),  
    //   '#default_value' => $config->get('welcome_message'),  
    // ];  

    $form['form_api'] = array( 
      '#type' => 'fieldset',
      '#title' => $this->t('Form API bits'),
      '#attributes' => array(
        'class' => array('mi_clase'),
      ),
    );

    //en los campos se debe add el nombre del contenedor antes
    //del nombre del campo ej = $form['datos_personales']['nombre'] 
    $form['form_api']['bits_message'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Clave api de bits'),
      '#description' => $this->t('Ingrese una clave con maximo 20 digitos'),
      '#default_value' => $config->get('bits_message'),
      '#size' => 60,
      '#maxlength' => 20,
      //'#pattern' => 'some-prefix-[a-z]+',
      '#required' => true,
    );
  
    return parent::buildForm($form, $form_state);  
  } 
  
  
  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('bits.adminsettings')  
      ->set('bits_message', $form_state->getValue('bits_message'))  
      ->save();  
  } 


}  