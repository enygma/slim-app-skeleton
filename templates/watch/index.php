{% extends 'layouts/main.php' %}

{% block content %}

<h2>Watching</h2>

<a href="/watch/create" class="btn btn-success">+ Add Watch</a>

<table class="table table-striped">
    <thead>
        <th>Username</th>
        <th>Posting To</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>
        {% for watch in watches %}
        <tr id="row-{{ watch.id }}">
            <td>{{ watch.username }}</td>
            <td>
                {% for target in watch.targets %}
                    {{ target.connector.getIdentifier() }}
                {% endfor %}
            </td>
            <td>
                <a href="" id="{{ watch.id }}" class="delete-watch"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>

<script>
$(function() {
    $('.delete-watch').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this watcher?')) {
            $.ajax({
                url: '/watch/'+id,
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
