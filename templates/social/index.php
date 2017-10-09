{% extends 'layouts/main.php' %}

{% block content %}

<h2>Current Connectors</h2>

<a href="{{ twitter_url }}" class="btn btn-success">Link Twitter</a>

<table class="table table-striped">
    <thead>
        <th>Type</th>
        <th>Identifier</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>
        {% for connector in connectors %}
        <tr id="row-{{ connector.id }}">
            <td>{{ connector.type|capitalize }}</td>
            <td>{{ connector.getIdentifier() }}</td>
            <td>
                <a href="" id="{{ connector.id }}" class="delete-connector"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>

<script>
$(function() {
    $('.delete-connector').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this connector? All related watches will also be removed.')) {
            $.ajax({
                url: '/social/'+id,
                method: 'DELETE',
                success: function(data) {
                    $('#row-'+id).remove();
                }
            });
        }
    });
});
</script>

{% endblock %}
