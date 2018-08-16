$(function() {
	/**
	 * Create jQuery extension class
	 *
	 * @param {Object} parent Parent class (To generate a class that does not inherit the parent class, set the prototype object of the child class as the first argument)
	 * @param {PrototypeObject} child Prototype object of child class (this._parent () can call method defined by parent)
	 * @return {Object} jQuery extension class
	 */
	$.Class = function(parent, child) {//{{{
		var cl = {};
		// Parent class definition
		if (typeof child === 'undefined') {
			cl.prototype = parent;
			// Define as static method
			for (var key in parent) {
				var method = parent[key];
				if (typeof method == 'function') cl[key] = method;
				delete cl.prototype[key];
			};
			if (cl.initialize) cl.initialize.call(cl); // Execute initialize at class execution
		// Child class definition
		} else {
			var parentMethods = $.extend({}, parent);
			var childMethods = {};
			// Functions that generate functions when overridden method invocation
			var override = function(name, fn) {
				return function() {
					var tmp = this._parent;
					this._parent = parentMethods[name];
					var ret = fn.apply(this, arguments);
					this._parent = tmp;
					return ret;
				};
			};
			// Define as static method
			for (var key in child) {
				var method = child[key];
				if (typeof method == 'function') childMethods[key] = method;
				delete child[key];
			};
			var extendMethods = $.extend({}, parent, childMethods); // Method inheritance of parent class
			// When overriding, call "this._parent ();" in the same function to call parent method
			for (var name in extendMethods) {
				var method = extendMethods[name];
				cl[name] = method;
				if (typeof parentMethods[name] == 'function') cl[name] = override(name, method);
			};
			if (childMethods.initialize) childMethods.initialize.call(cl); // Execute initialize at class execution
		}
		return cl;
	};//}}}
});
