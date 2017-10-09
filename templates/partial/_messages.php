{% if messages is defined %}
    {% if messages.errors is defined and messages.errors|length > 0 %}
    <div class="alert alert-danger">
        {% for error in messages.errors %}
            {{ error|raw }}<br/>
        {% endfor %}

        {% for key, errorSet in messages.errors %}
            {% for message in errorSet %}
                {{ message|raw }}<br/>
            {% endfor %}
        {% endfor %}
    </div>
    {% endif %}

    {% if messages.success is defined and messages.success|length > 0 %}
    <div class="alert alert-success">
        {% for message in messages.success %}
            {{ message|raw }}<br/>
        {% endfor %}
    </div>
    {% endif %}
{% endif %}
