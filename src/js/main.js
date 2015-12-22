var App = React.createClass({
    displayName: 'Hello',
    render: function() {
        return React.createElement("div", null, "Hello ", this.props.name);
    }
});

