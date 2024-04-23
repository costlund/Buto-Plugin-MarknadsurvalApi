# Buto-Plugin-MarknadsurvalApi



<a name="key_0"></a>

## Settings

<pre><code>plugin:
  marknadsurval:
    api:
      settings: '/../buto_data/theme/[theme]/marknadsurval.yml'</code></pre>
<p>Add parameter token to file marknadsurval.yml.</p>
<pre><code>token: '(my token)'</code></pre>

<a name="key_1"></a>

## Usage



<a name="key_2"></a>

## Pages



<a name="key_3"></a>

## Widgets



<a name="key_4"></a>

## Event



<a name="key_5"></a>

## Construct



<a name="key_5_0"></a>

### __construct



<a name="key_6"></a>

## Methods



<a name="key_6_0"></a>

### get_cupdate

<ul>
<li>Maken a request with a PID.</li>
<li>Put result in db.</li>
<li>Log to file.</li>
<li>Return result.</li>
</ul>
<pre><code>wfPlugin::includeonce('marknadsurval/api');
$api = new PluginMarknadsurvalApi();
$temp = $api-&gt;get_cupdate(wfRequest::get('pid'));
wfHelp::print($temp);</code></pre>
<p>Returns.</p>
<pre><code>pid: '196707238517'
first_name: 'James Goofy'
given_name: James
surname: Bond
address: 'Highway 3'
zip: '12345'
city: London
moved_at: ''
status: ok</code></pre>

