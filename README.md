# Buto-Plugin-MarknadsurvalApi

## Settings
```
plugin:
  marknadsurval:
    api:
      settings: '/../buto_data/theme/[theme]/marknadsurval.yml'
```

Add parameter token.
```
token: '(my token)'
```

## Method get_cupdate(pid)
```
wfPlugin::includeonce('marknadsurval/api');
$api = new PluginMarknadsurvalApi();
$temp = $api->get_cupdate(wfRequest::get('pid'));
wfHelp::print($temp);
```
Returns.
```
pid: '196707238517'
first_name: 'James Goofy'
given_name: James
surname: Bond
address: 'Highway 3'
zip: '12345'
city: London
moved_at: ''
status: ok
```
