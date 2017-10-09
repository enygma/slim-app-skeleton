{% extends 'layouts/main.php' %}

{% block content %}

<h2>User Dashboard</h2>

<a href="{{ twitter_url }}" class="btn btn-success">Link Twitter</a>

<h3>Connected</h3>
<table class="table table-striped">
    <thead>
        <th>Type</th>
        <th>Identifier</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>
        {% for connector in connectors %}
        <tr>
            <td>{{ connector.type|capitalize }}</td>
            <td>{{ connector.getIdentifier() }}</td>
            <td>
                <span class="glyphicon glyphicon-zoom-in"></span>
                <span class="glyphicon glyphicon-trash"></span>
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>

{% endblock %}
