{% extends 'layouts/main.php' %}

{% block content %}

<h2>Create Watch</h2>

{% include 'partial/_messages.php' %}

<form action="/watch/create" method="POST" class="form">
    <div class="form-group">
        <label for="username">Twitch Username:</label>
        <input type="text" class="form-control" name="username" id="username"/>
    </div>
    <div class="form-group">
        <label for="post_to">Post to:</label><br/>
        {% for connector in connectors %}
            {% if connector.type != 'twitch' %}
            <input type="checkbox" name="post_to[]" value="{{ connector.id }}"/>&nbsp;
                <img src="/assets/img/icons/{{ connector.type }}.png" height="20"/>&nbsp;&nbsp;
                {{ connector.getIdentifier() }}<br/>
            {% endif %}
        {% endfor %}
    </div>
    <button class="btn btn-success">Submit</button>
</form>

{% endblock %}
