<?php
class PluginMarknadsurvalApi{
  private $settings = null;
  private $url = 'http://api.marknadsurval.se/api/v1';
  private $token = null;
  function __construct(){
    wfPlugin::includeonce('wf/yml');
    $temp = wfPlugin::getPluginSettings('marknadsurval/api', true);
    $this->settings = new PluginWfYml(wfGlobals::getAppDir(). $temp->get('settings') );
    $this->token = $this->settings->get('token');
  }
  public function get_cupdate($pid){
    /**
     * get data
     */
    wfPlugin::includeonce('server/json');
    $server = new PluginServerJson();
    $get = '/cupdate/'.$pid;
    $result = $server->get($this->url.$get, array('X_TOKEN' => $this->token));
    $result = new PluginWfArray($result);
    /**
     * status
     */
    if(!$result->get('status')){
      if($result->get('daily-quota')){
        $result->set('status', 'daily-quota:'.$result->get('daily-quota'));
      }else{
        $result->set('status', 'Unknown error...');
      }
    }
    /**
     * db
     */
    wfPlugin::includeonce('marknadsurval/db');
    $db = new PluginMarknadsurvalDb();
    $insert = array();
    $insert['pid'] = $pid;
    $insert['first_name'] = $result->get('first_name');
    $insert['given_name'] = $result->get('given_name');
    $insert['surname'] = $result->get('surname');
    $insert['address'] = $result->get('address');
    $insert['zip'] = $result->get('zip');
    $insert['city'] = $result->get('city');
    $insert['moved_at'] = $result->get('moved_at');
    $insert['status'] = $result->get('status');
    $insert['api_name'] = 'marknadsurval';
    $db->marknadsurval_cupdate_insert($insert);
    /**
     * log
     */
    $log = new PluginWfYml(wfGlobals::getAppDir().'/../buto_data/theme/[theme]/plugin/marknadsurval/api/'.$this->token.'/'.date('Y-m').'.yml');
    $log->set('log/', array('time' => date('Y-m-d H:i:s'), 'pid' => wfUser::getSession()->get('plugin/banksignering/ui/pid'), 'result' => $result->get()));
    $log->set('count', sizeof($log->get('log')));
    $log->save();
    /**
     * Check secondary API
     */
    if($result->get('status')!='ok'){
      wfPlugin::includeonce('marknadsinformation/api');
      $api = new PluginMarknadsinformationApi();
      $api->get($pid);
    }
    /**
     * 
     */
    return $result;
  }
}