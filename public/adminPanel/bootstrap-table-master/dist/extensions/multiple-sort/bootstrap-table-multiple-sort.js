(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (global = typeof globalThis !== 'undefined' ? globalThis : global || self, factory(global.jQuery));
}(this, (function ($) { 'use strict';

  function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

  var $__default = /*#__PURE__*/_interopDefaultLegacy($);

  function _typeof(obj) {
    "@babel/helpers - typeof";

    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
      _typeof = function (obj) {
        return typeof obj;
      };
    } else {
      _typeof = function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
      };
    }

    return _typeof(obj);
  }

  var commonjsGlobal = typeof globalThis !== 'undefined' ? globalThis : typeof window !== 'undefined' ? window : typeof global !== 'undefined' ? global : typeof self !== 'undefined' ? self : {};

  function createCommonjsModule(fn, module) {
  	return module = { exports: {} }, fn(module, module.exports), module.exports;
  }

  var check = function (it) {
    return it && it.Math == Math && it;
  };

  // https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
  var global_1 =
    /* global globalThis -- safe */
    check(typeof globalThis == 'object' && globalThis) ||
    check(typeof window == 'object' && window) ||
    check(typeof self == 'object' && self) ||
    check(typeof commonjsGlobal == 'object' && commonjsGlobal) ||
    // eslint-disable-next-line no-new-func -- fallback
    (function () { return this; })() || Function('return this')();

  var fails = function (exec) {
    try {
      return !!exec();
    } catch (error) {
      return true;
    }
  };

  // Detect IE8's incomplete defineProperty implementation
  var descriptors = !fails(function () {
    return Object.defineProperty({}, 1, { get: function () { return 7; } })[1] != 7;
  });

  var nativePropertyIsEnumerable = {}.propertyIsEnumerable;
  var getOwnPropertyDescriptor$1 = Object.getOwnPropertyDescriptor;

  // Nashorn ~ JDK8 bug
  var NASHORN_BUG = getOwnPropertyDescriptor$1 && !nativePropertyIsEnumerable.call({ 1: 2 }, 1);

  // `Object.prototype.propertyIsEnumerable` method implementation
  // https://tc39.es/ecma262/#sec-object.prototype.propertyisenumerable
  var f$4 = NASHORN_BUG ? function propertyIsEnumerable(V) {
    var descriptor = getOwnPropertyDescriptor$1(this, V);
    return !!descriptor && descriptor.enumerable;
  } : nativePropertyIsEnumerable;

  var objectPropertyIsEnumerable = {
  	f: f$4
  };

  var createPropertyDescriptor = function (bitmap, value) {
    return {
      enumerable: !(bitmap & 1),
      configurable: !(bitmap & 2),
      writable: !(bitmap & 4),
      value: value
    };
  };

  var toString = {}.toString;

  var classofRaw = function (it) {
    return toString.call(it).slice(8, -1);
  };

  var split = ''.split;

  // fallback for non-array-like ES3 and non-enumerable old V8 strings
  var indexedObject = fails(function () {
    // throws an error in rhino, see https://github.com/mozilla/rhino/issues/346
    // eslint-disable-next-line no-prototype-builtins -- safe
    return !Object('z').propertyIsEnumerable(0);
  }) ? function (it) {
    return classofRaw(it) == 'String' ? split.call(it, '') : Object(it);
  } : Object;

  // `RequireObjectCoercible` abstract operation
  // https://tc39.es/ecma262/#sec-requireobjectcoercible
  var requireObjectCoercible = function (it) {
    if (it == undefined) throw TypeError("Can't call method on " + it);
    return it;
  };

  // toObject with fallback for non-array-like ES3 strings



  var toIndexedObject = function (it) {
    return indexedObject(requireObjectCoercible(it));
  };

  var isObject = function (it) {
    return typeof it === 'object' ? it !== null : typeof it === 'function';
  };

  // `ToPrimitive` abstract operation
  // https://tc39.es/ecma262/#sec-toprimitive
  // instead of the ES6 spec version, we didn't implement @@toPrimitive case
  // and the second argument - flag - preferred type is a string
  var toPrimitive = function (input, PREFERRED_STRING) {
    if (!isObject(input)) return input;
    var fn, val;
    if (PREFERRED_STRING && typeof (fn = input.toString) == 'function' && !isObject(val = fn.call(input))) return val;
    if (typeof (fn = input.valueOf) == 'function' && !isObject(val = fn.call(input))) return val;
    if (!PREFERRED_STRING && typeof (fn = input.toString) == 'function' && !isObject(val = fn.call(input))) return val;
    throw TypeError("Can't convert object to primitive value");
  };

  var hasOwnProperty = {}.hasOwnProperty;

  var has$1 = function (it, key) {
    return hasOwnProperty.call(it, key);
  };

  var document$1 = global_1.document;
  // typeof document.createElement is 'object' in old IE
  var EXISTS = isObject(document$1) && isObject(document$1.createElement);

  var documentCreateElement = function (it) {
    return EXISTS ? document$1.createElement(it) : {};
  };

  // Thank's IE8 for his funny defineProperty
  var ie8DomDefine = !descriptors && !fails(function () {
    return Object.defineProperty(documentCreateElement('div'), 'a', {
      get: function () { return 7; }
    }).a != 7;
  });

  var nativeGetOwnPropertyDescriptor = Object.getOwnPropertyDescriptor;

  // `Object.getOwnPropertyDescriptor` method
  // https://tc39.es/ecma262/#sec-object.getownpropertydescriptor
  var f$3 = descriptors ? nativeGetOwnPropertyDescriptor : function getOwnPropertyDescriptor(O, P) {
    O = toIndexedObject(O);
    P = toPrimitive(P, true);
    if (ie8DomDefine) try {
      return nativeGetOwnPropertyDescriptor(O, P);
    } catch (error) { /* empty */ }
    if (has$1(O, P)) return createPropertyDescriptor(!objectPropertyIsEnumerable.f.call(O, P), O[P]);
  };

  var objectGetOwnPropertyDescriptor = {
  	f: f$3
  };

  var anObject = function (it) {
    if (!isObject(it)) {
      throw TypeError(String(it) + ' is not an object');
    } return it;
  };

  var nativeDefineProperty = Object.defineProperty;

  // `Object.defineProperty` method
  // https://tc39.es/ecma262/#sec-object.defineproperty
  var f$2 = descriptors ? nativeDefineProperty : function defineProperty(O, P, Attributes) {
    anObject(O);
    P = toPrimitive(P, true);
    anObject(Attributes);
    if (ie8DomDefine) try {
      return nativeDefineProperty(O, P, Attributes);
    } catch (error) { /* empty */ }
    if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported');
    if ('value' in Attributes) O[P] = Attributes.value;
    return O;
  };

  var objectDefineProperty = {
  	f: f$2
  };

  var createNonEnumerableProperty = descriptors ? function (object, key, value) {
    return objectDefineProperty.f(object, key, createPropertyDescriptor(1, value));
  } : function (object, key, value) {
    object[key] = value;
    return object;
  };

  var setGlobal = function (key, value) {
    try {
      createNonEnumerableProperty(global_1, key, value);
    } catch (error) {
      global_1[key] = value;
    } return value;
  };

  var SHARED = '__core-js_shared__';
  var store$1 = global_1[SHARED] || setGlobal(SHARED, {});

  var sharedStore = store$1;

  var functionToString = Function.toString;

  // this helper broken in `3.4.1-3.4.4`, so we can't use `shared` helper
  if (typeof sharedStore.inspectSource != 'function') {
    sharedStore.inspectSource = function (it) {
      return functionToString.call(it);
    };
  }

  var inspectSource = sharedStore.inspectSource;

  var WeakMap$1 = global_1.WeakMap;

  var nativeWeakMap = typeof WeakMap$1 === 'function' && /native code/.test(inspectSource(WeakMap$1));

  var shared = createCommonjsModule(function (module) {
  (module.exports = function (key, value) {
    return sharedStore[key] || (sharedStore[key] = value !== undefined ? value : {});
  })('versions', []).push({
    version: '3.9.1',
    mode: 'global',
    copyright: '© 2021 Denis Pushkarev (zloirock.ru)'
  });
  });

  var id = 0;
  var postfix = Math.random();

  var uid = function (key) {
    return 'Symbol(' + String(key === undefined ? '' : key) + ')_' + (++id + postfix).toString(36);
  };

  var keys = shared('keys');

  var sharedKey = function (key) {
    return keys[key] || (keys[key] = uid(key));
  };

  var hiddenKeys$1 = {};

  var WeakMap = global_1.WeakMap;
  var set, get, has;

  var enforce = function (it) {
    return has(it) ? get(it) : set(it, {});
  };

  var getterFor = function (TYPE) {
    return function (it) {
      var state;
      if (!isObject(it) || (state = get(it)).type !== TYPE) {
        throw TypeError('Incompatible receiver, ' + TYPE + ' required');
      } return state;
    };
  };

  if (nativeWeakMap) {
    var store = sharedStore.state || (sharedStore.state = new WeakMap());
    var wmget = store.get;
    var wmhas = store.has;
    var wmset = store.set;
    set = function (it, metadata) {
      metadata.facade = it;
      wmset.call(store, it, metadata);
      return metadata;
    };
    get = function (it) {
      return wmget.call(store, it) || {};
    };
    has = function (it) {
      return wmhas.call(store, it);
    };
  } else {
    var STATE = sharedKey('state');
    hiddenKeys$1[STATE] = true;
    set = function (it, metadata) {
      metadata.facade = it;
      createNonEnumerableProperty(it, STATE, metadata);
      return metadata;
    };
    get = function (it) {
      return has$1(it, STATE) ? it[STATE] : {};
    };
    has = function (it) {
      return has$1(it, STATE);
    };
  }

  var internalState = {
    set: set,
    get: get,
    has: has,
    enforce: enforce,
    getterFor: getterFor
  };

  var redefine = createCommonjsModule(function (module) {
  var getInternalState = internalState.get;
  var enforceInternalState = internalState.enforce;
  var TEMPLATE = String(String).split('String');

  (module.exports = function (O, key, value, options) {
    var unsafe = options ? !!options.unsafe : false;
    var simple = options ? !!options.enumerable : false;
    var noTargetGet = options ? !!options.noTargetGet : false;
    var state;
    if (typeof value == 'function') {
      if (typeof key == 'string' && !has$1(value, 'name')) {
        createNonEnumerableProperty(value, 'name', key);
      }
      state = enforceInternalState(value);
      if (!state.source) {
        state.source = TEMPLATE.join(typeof key == 'string' ? key : '');
      }
    }
    if (O === global_1) {
      if (simple) O[key] = value;
      else setGlobal(key, value);
      return;
    } else if (!unsafe) {
      delete O[key];
    } else if (!noTargetGet && O[key]) {
      simple = true;
    }
    if (simple) O[key] = value;
    else createNonEnumerableProperty(O, key, value);
  // add fake Function#toString for correct work wrapped methods / constructors with methods like LoDash isNative
  })(Function.prototype, 'toString', function toString() {
    return typeof this == 'function' && getInternalState(this).source || inspectSource(this);
  });
  });

  var path = global_1;

  var aFunction$1 = function (variable) {
    return typeof variable == 'function' ? variable : undefined;
  };

  var getBuiltIn = function (namespace, method) {
    return arguments.length < 2 ? aFunction$1(path[namespace]) || aFunction$1(global_1[namespace])
      : path[namespace] && path[namespace][method] || global_1[namespace] && global_1[namespace][method];
  };

  var ceil = Math.ceil;
  var floor = Math.floor;

  // `ToInteger` abstract operation
  // https://tc39.es/ecma262/#sec-tointeger
  var toInteger = function (argument) {
    return isNaN(argument = +argument) ? 0 : (argument > 0 ? floor : ceil)(argument);
  };

  var min$2 = Math.min;

  // `ToLength` abstract operation
  // https://tc39.es/ecma262/#sec-tolength
  var toLength = function (argument) {
    return argument > 0 ? min$2(toInteger(argument), 0x1FFFFFFFFFFFFF) : 0; // 2 ** 53 - 1 == 9007199254740991
  };

  var max$2 = Math.max;
  var min$1 = Math.min;

  // Helper for a popular repeating case of the spec:
  // Let integer be ? ToInteger(index).
  // If integer < 0, let result be max((length + integer), 0); else let result be min(integer, length).
  var toAbsoluteIndex = function (index, length) {
    var integer = toInteger(index);
    return integer < 0 ? max$2(integer + length, 0) : min$1(integer, length);
  };

  // `Array.prototype.{ indexOf, includes }` methods implementation
  var createMethod$2 = function (IS_INCLUDES) {
    return function ($this, el, fromIndex) {
      var O = toIndexedObject($this);
      var length = toLength(O.length);
      var index = toAbsoluteIndex(fromIndex, length);
      var value;
      // Array#includes uses SameValueZero equality algorithm
      // eslint-disable-next-line no-self-compare -- NaN check
      if (IS_INCLUDES && el != el) while (length > index) {
        value = O[index++];
        // eslint-disable-next-line no-self-compare -- NaN check
        if (value != value) return true;
      // Array#indexOf ignores holes, Array#includes - not
      } else for (;length > index; index++) {
        if ((IS_INCLUDES || index in O) && O[index] === el) return IS_INCLUDES || index || 0;
      } return !IS_INCLUDES && -1;
    };
  };

  var arrayIncludes = {
    // `Array.prototype.includes` method
    // https://tc39.es/ecma262/#sec-array.prototype.includes
    includes: createMethod$2(true),
    // `Array.prototype.indexOf` method
    // https://tc39.es/ecma262/#sec-array.prototype.indexof
    indexOf: createMethod$2(false)
  };

  var indexOf = arrayIncludes.indexOf;


  var objectKeysInternal = function (object, names) {
    var O = toIndexedObject(object);
    var i = 0;
    var result = [];
    var key;
    for (key in O) !has$1(hiddenKeys$1, key) && has$1(O, key) && result.push(key);
    // Don't enum bug & hidden keys
    while (names.length > i) if (has$1(O, key = names[i++])) {
      ~indexOf(result, key) || result.push(key);
    }
    return result;
  };

  // IE8- don't enum bug keys
  var enumBugKeys = [
    'constructor',
    'hasOwnProperty',
    'isPrototypeOf',
    'propertyIsEnumerable',
    'toLocaleString',
    'toString',
    'valueOf'
  ];

  var hiddenKeys = enumBugKeys.concat('length', 'prototype');

  // `Object.getOwnPropertyNames` method
  // https://tc39.es/ecma262/#sec-object.getownpropertynames
  var f$1 = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
    return objectKeysInternal(O, hiddenKeys);
  };

  var objectGetOwnPropertyNames = {
  	f: f$1
  };

  var f = Object.getOwnPropertySymbols;

  var objectGetOwnPropertySymbols = {
  	f: f
  };

  // all object keys, includes non-enumerable and symbols
  var ownKeys = getBuiltIn('Reflect', 'ownKeys') || function ownKeys(it) {
    var keys = objectGetOwnPropertyNames.f(anObject(it));
    var getOwnPropertySymbols = objectGetOwnPropertySymbols.f;
    return getOwnPropertySymbols ? keys.concat(getOwnPropertySymbols(it)) : keys;
  };

  var copyConstructorProperties = function (target, source) {
    var keys = ownKeys(source);
    var defineProperty = objectDefineProperty.f;
    var getOwnPropertyDescriptor = objectGetOwnPropertyDescriptor.f;
    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];
      if (!has$1(target, key)) defineProperty(target, key, getOwnPropertyDescriptor(source, key));
    }
  };

  var replacement = /#|\.prototype\./;

  var isForced = function (feature, detection) {
    var value = data[normalize(feature)];
    return value == POLYFILL ? true
      : value == NATIVE ? false
      : typeof detection == 'function' ? fails(detection)
      : !!detection;
  };

  var normalize = isForced.normalize = function (string) {
    return String(string).replace(replacement, '.').toLowerCase();
  };

  var data = isForced.data = {};
  var NATIVE = isForced.NATIVE = 'N';
  var POLYFILL = isForced.POLYFILL = 'P';

  var isForced_1 = isForced;

  var getOwnPropertyDescriptor = objectGetOwnPropertyDescriptor.f;






  /*
    options.target      - name of the target object
    options.global      - target is the global object
    options.stat        - export as static methods of target
    options.proto       - export as prototype methods of target
    options.real        - real prototype method for the `pure` version
    options.forced      - export even if the native feature is available
    options.bind        - bind methods to the target, required for the `pure` version
    options.wrap        - wrap constructors to preventing global pollution, required for the `pure` version
    options.unsafe      - use the simple assignment of property instead of delete + defineProperty
    options.sham        - add a flag to not completely full polyfills
    options.enumerable  - export as enumerable property
    options.noTargetGet - prevent calling a getter on target
  */
  var _export = function (options, source) {
    var TARGET = options.target;
    var GLOBAL = options.global;
    var STATIC = options.stat;
    var FORCED, target, key, targetProperty, sourceProperty, descriptor;
    if (GLOBAL) {
      target = global_1;
    } else if (STATIC) {
      target = global_1[TARGET] || setGlobal(TARGET, {});
    } else {
      target = (global_1[TARGET] || {}).prototype;
    }
    if (target) for (key in source) {
      sourceProperty = source[key];
      if (options.noTargetGet) {
        descriptor = getOwnPropertyDescriptor(target, key);
        targetProperty = descriptor && descriptor.value;
      } else targetProperty = target[key];
      FORCED = isForced_1(GLOBAL ? key : TARGET + (STATIC ? '.' : '#') + key, options.forced);
      // contained in target
      if (!FORCED && targetProperty !== undefined) {
        if (typeof sourceProperty === typeof targetProperty) continue;
        copyConstructorProperties(sourceProperty, targetProperty);
      }
      // add a flag to not completely full polyfills
      if (options.sham || (targetProperty && targetProperty.sham)) {
        createNonEnumerableProperty(sourceProperty, 'sham', true);
      }
      // extend global
      redefine(target, key, sourceProperty, options);
    }
  };

  var aFunction = function (it) {
    if (typeof it != 'function') {
      throw TypeError(String(it) + ' is not a function');
    } return it;
  };

  // optional / simple context binding
  var functionBindContext = function (fn, that, length) {
    aFunction(fn);
    if (that === undefined) return fn;
    switch (length) {
      case 0: return function () {
        return fn.call(that);
      };
      case 1: return function (a) {
        return fn.call(that, a);
      };
      case 2: return function (a, b) {
        return fn.call(that, a, b);
      };
      case 3: return function (a, b, c) {
        return fn.call(that, a, b, c);
      };
    }
    return function (/* ...args */) {
      return fn.apply(that, arguments);
    };
  };

  // `ToObject` abstract operation
  // https://tc39.es/ecma262/#sec-toobject
  var toObject = function (argument) {
    return Object(requireObjectCoercible(argument));
  };

  // `IsArray` abstract operation
  // https://tc39.es/ecma262/#sec-isarray
  var isArray = Array.isArray || function isArray(arg) {
    return classofRaw(arg) == 'Array';
  };

  var engineIsNode = classofRaw(global_1.process) == 'process';

  var engineUserAgent = getBuiltIn('navigator', 'userAgent') || '';

  var process = global_1.process;
  var versions = process && process.versions;
  var v8 = versions && versions.v8;
  var match, version;

  if (v8) {
    match = v8.split('.');
    version = match[0] + match[1];
  } else if (engineUserAgent) {
    match = engineUserAgent.match(/Edge\/(\d+)/);
    if (!match || match[1] >= 74) {
      match = engineUserAgent.match(/Chrome\/(\d+)/);
      if (match) version = match[1];
    }
  }

  var engineV8Version = version && +version;

  var nativeSymbol = !!Object.getOwnPropertySymbols && !fails(function () {
    /* global Symbol -- required for testing */
    return !Symbol.sham &&
      // Chrome 38 Symbol has incorrect toString conversion
      // Chrome 38-40 symbols are not inherited from DOM collections prototypes to instances
      (engineIsNode ? engineV8Version === 38 : engineV8Version > 37 && engineV8Version < 41);
  });

  var useSymbolAsUid = nativeSymbol
    /* global Symbol -- safe */
    && !Symbol.sham
    && typeof Symbol.iterator == 'symbol';

  var WellKnownSymbolsStore = shared('wks');
  var Symbol$1 = global_1.Symbol;
  var createWellKnownSymbol = useSymbolAsUid ? Symbol$1 : Symbol$1 && Symbol$1.withoutSetter || uid;

  var wellKnownSymbol = function (name) {
    if (!has$1(WellKnownSymbolsStore, name) || !(nativeSymbol || typeof WellKnownSymbolsStore[name] == 'string')) {
      if (nativeSymbol && has$1(Symbol$1, name)) {
        WellKnownSymbolsStore[name] = Symbol$1[name];
      } else {
        WellKnownSymbolsStore[name] = createWellKnownSymbol('Symbol.' + name);
      }
    } return WellKnownSymbolsStore[name];
  };

  var SPECIES$2 = wellKnownSymbol('species');

  // `ArraySpeciesCreate` abstract operation
  // https://tc39.es/ecma262/#sec-arrayspeciescreate
  var arraySpeciesCreate = function (originalArray, length) {
    var C;
    if (isArray(originalArray)) {
      C = originalArray.constructor;
      // cross-realm fallback
      if (typeof C == 'function' && (C === Array || isArray(C.prototype))) C = undefined;
      else if (isObject(C)) {
        C = C[SPECIES$2];
        if (C === null) C = undefined;
      }
    } return new (C === undefined ? Array : C)(length === 0 ? 0 : length);
  };

  var push = [].push;

  // `Array.prototype.{ forEach, map, filter, some, every, find, findIndex, filterOut }` methods implementation
  var createMethod$1 = function (TYPE) {
    var IS_MAP = TYPE == 1;
    var IS_FILTER = TYPE == 2;
    var IS_SOME = TYPE == 3;
    var IS_EVERY = TYPE == 4;
    var IS_FIND_INDEX = TYPE == 6;
    var IS_FILTER_OUT = TYPE == 7;
    var NO_HOLES = TYPE == 5 || IS_FIND_INDEX;
    return function ($this, callbackfn, that, specificCreate) {
      var O = toObject($this);
      var self = indexedObject(O);
      var boundFunction = functionBindContext(callbackfn, that, 3);
      var length = toLength(self.length);
      var index = 0;
      var create = specificCreate || arraySpeciesCreate;
      var target = IS_MAP ? create($this, length) : IS_FILTER || IS_FILTER_OUT ? create($this, 0) : undefined;
      var value, result;
      for (;length > index; index++) if (NO_HOLES || index in self) {
        value = self[index];
        result = boundFunction(value, index, O);
        if (TYPE) {
          if (IS_MAP) target[index] = result; // map
          else if (result) switch (TYPE) {
            case 3: return true;              // some
            case 5: return value;             // find
            case 6: return index;             // findIndex
            case 2: push.call(target, value); // filter
          } else switch (TYPE) {
            case 4: return false;             // every
            case 7: push.call(target, value); // filterOut
          }
        }
      }
      return IS_FIND_INDEX ? -1 : IS_SOME || IS_EVERY ? IS_EVERY : target;
    };
  };

  var arrayIteration = {
    // `Array.prototype.forEach` method
    // https://tc39.es/ecma262/#sec-array.prototype.foreach
    forEach: createMethod$1(0),
    // `Array.prototype.map` method
    // https://tc39.es/ecma262/#sec-array.prototype.map
    map: createMethod$1(1),
    // `Array.prototype.filter` method
    // https://tc39.es/ecma262/#sec-array.prototype.filter
    filter: createMethod$1(2),
    // `Array.prototype.some` method
    // https://tc39.es/ecma262/#sec-array.prototype.some
    some: createMethod$1(3),
    // `Array.prototype.every` method
    // https://tc39.es/ecma262/#sec-array.prototype.every
    every: createMethod$1(4),
    // `Array.prototype.find` method
    // https://tc39.es/ecma262/#sec-array.prototype.find
    find: createMethod$1(5),
    // `Array.prototype.findIndex` method
    // https://tc39.es/ecma262/#sec-array.prototype.findIndex
    findIndex: createMethod$1(6),
    // `Array.prototype.filterOut` method
    // https://github.com/tc39/proposal-array-filtering
    filterOut: createMethod$1(7)
  };

  // `Object.keys` method
  // https://tc39.es/ecma262/#sec-object.keys
  var objectKeys = Object.keys || function keys(O) {
    return objectKeysInternal(O, enumBugKeys);
  };

  // `Object.defineProperties` method
  // https://tc39.es/ecma262/#sec-object.defineproperties
  var objectDefineProperties = descriptors ? Object.defineProperties : function defineProperties(O, Properties) {
    anObject(O);
    var keys = objectKeys(Properties);
    var length = keys.length;
    var index = 0;
    var key;
    while (length > index) objectDefineProperty.f(O, key = keys[index++], Properties[key]);
    return O;
  };

  var html = getBuiltIn('document', 'documentElement');

  var GT = '>';
  var LT = '<';
  var PROTOTYPE = 'prototype';
  var SCRIPT = 'script';
  var IE_PROTO = sharedKey('IE_PROTO');

  var EmptyConstructor = function () { /* empty */ };

  var scriptTag = function (content) {
    return LT + SCRIPT + GT + content + LT + '/' + SCRIPT + GT;
  };

  // Create object with fake `null` prototype: use ActiveX Object with cleared prototype
  var NullProtoObjectViaActiveX = function (activeXDocument) {
    activeXDocument.write(scriptTag(''));
    activeXDocument.close();
    var temp = activeXDocument.parentWindow.Object;
    activeXDocument = null; // avoid memory leak
    return temp;
  };

  // Create object with fake `null` prototype: use iframe Object with cleared prototype
  var NullProtoObjectViaIFrame = function () {
    // Thrash, waste and sodomy: IE GC bug
    var iframe = documentCreateElement('iframe');
    var JS = 'java' + SCRIPT + ':';
    var iframeDocument;
    iframe.style.display = 'none';
    html.appendChild(iframe);
    // https://github.com/zloirock/core-js/issues/475
    iframe.src = String(JS);
    iframeDocument = iframe.contentWindow.document;
    iframeDocument.open();
    iframeDocument.write(scriptTag('document.F=Object'));
    iframeDocument.close();
    return iframeDocument.F;
  };

  // Check for document.domain and active x support
  // No need to use active x approach when document.domain is not set
  // see https://github.com/es-shims/es5-shim/issues/150
  // variation of https://github.com/kitcambridge/es5-shim/commit/4f738ac066346
  // avoid IE GC bug
  var activeXDocument;
  var NullProtoObject = function () {
    try {
      /* global ActiveXObject -- old IE */
      activeXDocument = document.domain && new ActiveXObject('htmlfile');
    } catch (error) { /* ignore */ }
    NullProtoObject = activeXDocument ? NullProtoObjectViaActiveX(activeXDocument) : NullProtoObjectViaIFrame();
    var length = enumBugKeys.length;
    while (length--) delete NullProtoObject[PROTOTYPE][enumBugKeys[length]];
    return NullProtoObject();
  };

  hiddenKeys$1[IE_PROTO] = true;

  // `Object.create` method
  // https://tc39.es/ecma262/#sec-object.create
  var objectCreate = Object.create || function create(O, Properties) {
    var result;
    if (O !== null) {
      EmptyConstructor[PROTOTYPE] = anObject(O);
      result = new EmptyConstructor();
      EmptyConstructor[PROTOTYPE] = null;
      // add "__proto__" for Object.getPrototypeOf polyfill
      result[IE_PROTO] = O;
    } else result = NullProtoObject();
    return Properties === undefined ? result : objectDefineProperties(result, Properties);
  };

  var UNSCOPABLES = wellKnownSymbol('unscopables');
  var ArrayPrototype = Array.prototype;

  // Array.prototype[@@unscopables]
  // https://tc39.es/ecma262/#sec-array.prototype-@@unscopables
  if (ArrayPrototype[UNSCOPABLES] == undefined) {
    objectDefineProperty.f(ArrayPrototype, UNSCOPABLES, {
      configurable: true,
      value: objectCreate(null)
    });
  }

  // add a key to Array.prototype[@@unscopables]
  var addToUnscopables = function (key) {
    ArrayPrototype[UNSCOPABLES][key] = true;
  };

  var $find = arrayIteration.find;


  var FIND = 'find';
  var SKIPS_HOLES = true;

  // Shouldn't skip holes
  if (FIND in []) Array(1)[FIND](function () { SKIPS_HOLES = false; });

  // `Array.prototype.find` method
  // https://tc39.es/ecma262/#sec-array.prototype.find
  _export({ target: 'Array', proto: true, forced: SKIPS_HOLES }, {
    find: function find(callbackfn /* , that = undefined */) {
      return $find(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
    }
  });

  // https://tc39.es/ecma262/#sec-array.prototype-@@unscopables
  addToUnscopables(FIND);

  var SPECIES$1 = wellKnownSymbol('species');

  var arrayMethodHasSpeciesSupport = function (METHOD_NAME) {
    // We can't use this feature detection in V8 since it causes
    // deoptimization and serious performance degradation
    // https://github.com/zloirock/core-js/issues/677
    return engineV8Version >= 51 || !fails(function () {
      var array = [];
      var constructor = array.constructor = {};
      constructor[SPECIES$1] = function () {
        return { foo: 1 };
      };
      return array[METHOD_NAME](Boolean).foo !== 1;
    });
  };

  var $map = arrayIteration.map;


  var HAS_SPECIES_SUPPORT$2 = arrayMethodHasSpeciesSupport('map');

  // `Array.prototype.map` method
  // https://tc39.es/ecma262/#sec-array.prototype.map
  // with adding support of @@species
  _export({ target: 'Array', proto: true, forced: !HAS_SPECIES_SUPPORT$2 }, {
    map: function map(callbackfn /* , thisArg */) {
      return $map(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
    }
  });

  var arrayMethodIsStrict = function (METHOD_NAME, argument) {
    var method = [][METHOD_NAME];
    return !!method && fails(function () {
      // eslint-disable-next-line no-useless-call,no-throw-literal -- required for testing
      method.call(null, argument || function () { throw 1; }, 1);
    });
  };

  var test$1 = [];
  var nativeSort = test$1.sort;

  // IE8-
  var FAILS_ON_UNDEFINED = fails(function () {
    test$1.sort(undefined);
  });
  // V8 bug
  var FAILS_ON_NULL = fails(function () {
    test$1.sort(null);
  });
  // Old WebKit
  var STRICT_METHOD$1 = arrayMethodIsStrict('sort');

  var FORCED$2 = FAILS_ON_UNDEFINED || !FAILS_ON_NULL || !STRICT_METHOD$1;

  // `Array.prototype.sort` method
  // https://tc39.es/ecma262/#sec-array.prototype.sort
  _export({ target: 'Array', proto: true, forced: FORCED$2 }, {
    sort: function sort(comparefn) {
      return comparefn === undefined
        ? nativeSort.call(toObject(this))
        : nativeSort.call(toObject(this), aFunction(comparefn));
    }
  });

  var createProperty = function (object, key, value) {
    var propertyKey = toPrimitive(key);
    if (propertyKey in object) objectDefineProperty.f(object, propertyKey, createPropertyDescriptor(0, value));
    else object[propertyKey] = value;
  };

  var IS_CONCAT_SPREADABLE = wellKnownSymbol('isConcatSpreadable');
  var MAX_SAFE_INTEGER$1 = 0x1FFFFFFFFFFFFF;
  var MAXIMUM_ALLOWED_INDEX_EXCEEDED = 'Maximum allowed index exceeded';

  // We can't use this feature detection in V8 since it causes
  // deoptimization and serious performance degradation
  // https://github.com/zloirock/core-js/issues/679
  var IS_CONCAT_SPREADABLE_SUPPORT = engineV8Version >= 51 || !fails(function () {
    var array = [];
    array[IS_CONCAT_SPREADABLE] = false;
    return array.concat()[0] !== array;
  });

  var SPECIES_SUPPORT = arrayMethodHasSpeciesSupport('concat');

  var isConcatSpreadable = function (O) {
    if (!isObject(O)) return false;
    var spreadable = O[IS_CONCAT_SPREADABLE];
    return spreadable !== undefined ? !!spreadable : isArray(O);
  };

  var FORCED$1 = !IS_CONCAT_SPREADABLE_SUPPORT || !SPECIES_SUPPORT;

  // `Array.prototype.concat` method
  // https://tc39.es/ecma262/#sec-array.prototype.concat
  // with adding support of @@isConcatSpreadable and @@species
  _export({ target: 'Array', proto: true, forced: FORCED$1 }, {
    // eslint-disable-next-line no-unused-vars -- required for `.length`
    concat: function concat(arg) {
      var O = toObject(this);
      var A = arraySpeciesCreate(O, 0);
      var n = 0;
      var i, k, length, len, E;
      for (i = -1, length = arguments.length; i < length; i++) {
        E = i === -1 ? O : arguments[i];
        if (isConcatSpreadable(E)) {
          len = toLength(E.length);
          if (n + len > MAX_SAFE_INTEGER$1) throw TypeError(MAXIMUM_ALLOWED_INDEX_EXCEEDED);
          for (k = 0; k < len; k++, n++) if (k in E) createProperty(A, n, E[k]);
        } else {
          if (n >= MAX_SAFE_INTEGER$1) throw TypeError(MAXIMUM_ALLOWED_INDEX_EXCEEDED);
          createProperty(A, n++, E);
        }
      }
      A.length = n;
      return A;
    }
  });

  var nativeAssign = Object.assign;
  var defineProperty = Object.defineProperty;

  // `Object.assign` method
  // https://tc39.es/ecma262/#sec-object.assign
  var objectAssign = !nativeAssign || fails(function () {
    // should have correct order of operations (Edge bug)
    if (descriptors && nativeAssign({ b: 1 }, nativeAssign(defineProperty({}, 'a', {
      enumerable: true,
      get: function () {
        defineProperty(this, 'b', {
          value: 3,
          enumerable: false
        });
      }
    }), { b: 2 })).b !== 1) return true;
    // should work with symbols and should have deterministic property order (V8 bug)
    var A = {};
    var B = {};
    /* global Symbol -- required for testing */
    var symbol = Symbol();
    var alphabet = 'abcdefghijklmnopqrst';
    A[symbol] = 7;
    alphabet.split('').forEach(function (chr) { B[chr] = chr; });
    return nativeAssign({}, A)[symbol] != 7 || objectKeys(nativeAssign({}, B)).join('') != alphabet;
  }) ? function assign(target, source) { // eslint-disable-line no-unused-vars -- required for `.length`
    var T = toObject(target);
    var argumentsLength = arguments.length;
    var index = 1;
    var getOwnPropertySymbols = objectGetOwnPropertySymbols.f;
    var propertyIsEnumerable = objectPropertyIsEnumerable.f;
    while (argumentsLength > index) {
      var S = indexedObject(arguments[index++]);
      var keys = getOwnPropertySymbols ? objectKeys(S).concat(getOwnPropertySymbols(S)) : objectKeys(S);
      var length = keys.length;
      var j = 0;
      var key;
      while (length > j) {
        key = keys[j++];
        if (!descriptors || propertyIsEnumerable.call(S, key)) T[key] = S[key];
      }
    } return T;
  } : nativeAssign;

  // `Object.assign` method
  // https://tc39.es/ecma262/#sec-object.assign
  _export({ target: 'Object', stat: true, forced: Object.assign !== objectAssign }, {
    assign: objectAssign
  });

  var HAS_SPECIES_SUPPORT$1 = arrayMethodHasSpeciesSupport('slice');

  var SPECIES = wellKnownSymbol('species');
  var nativeSlice = [].slice;
  var max$1 = Math.max;

  // `Array.prototype.slice` method
  // https://tc39.es/ecma262/#sec-array.prototype.slice
  // fallback for not array-like ES3 strings and DOM objects
  _export({ target: 'Array', proto: true, forced: !HAS_SPECIES_SUPPORT$1 }, {
    slice: function slice(start, end) {
      var O = toIndexedObject(this);
      var length = toLength(O.length);
      var k = toAbsoluteIndex(start, length);
      var fin = toAbsoluteIndex(end === undefined ? length : end, length);
      // inline `ArraySpeciesCreate` for usage native `Array#slice` where it's possible
      var Constructor, result, n;
      if (isArray(O)) {
        Constructor = O.constructor;
        // cross-realm fallback
        if (typeof Constructor == 'function' && (Constructor === Array || isArray(Constructor.prototype))) {
          Constructor = undefined;
        } else if (isObject(Constructor)) {
          Constructor = Constructor[SPECIES];
          if (Constructor === null) Constructor = undefined;
        }
        if (Constructor === Array || Constructor === undefined) {
          return nativeSlice.call(O, k, fin);
        }
      }
      result = new (Constructor === undefined ? Array : Constructor)(max$1(fin - k, 0));
      for (n = 0; k < fin; k++, n++) if (k in O) createProperty(result, n, O[k]);
      result.length = n;
      return result;
    }
  });

  var HAS_SPECIES_SUPPORT = arrayMethodHasSpeciesSupport('splice');

  var max = Math.max;
  var min = Math.min;
  var MAX_SAFE_INTEGER = 0x1FFFFFFFFFFFFF;
  var MAXIMUM_ALLOWED_LENGTH_EXCEEDED = 'Maximum allowed length exceeded';

  // `Array.prototype.splice` method
  // https://tc39.es/ecma262/#sec-array.prototype.splice
  // with adding support of @@species
  _export({ target: 'Array', proto: true, forced: !HAS_SPECIES_SUPPORT }, {
    splice: function splice(start, deleteCount /* , ...items */) {
      var O = toObject(this);
      var len = toLength(O.length);
      var actualStart = toAbsoluteIndex(start, len);
      var argumentsLength = arguments.length;
      var insertCount, actualDeleteCount, A, k, from, to;
      if (argumentsLength === 0) {
        insertCount = actualDeleteCount = 0;
      } else if (argumentsLength === 1) {
        insertCount = 0;
        actualDeleteCount = len - actualStart;
      } else {
        insertCount = argumentsLength - 2;
        actualDeleteCount = min(max(toInteger(deleteCount), 0), len - actualStart);
      }
      if (len + insertCount - actualDeleteCount > MAX_SAFE_INTEGER) {
        throw TypeError(MAXIMUM_ALLOWED_LENGTH_EXCEEDED);
      }
      A = arraySpeciesCreate(O, actualDeleteCount);
      for (k = 0; k < actualDeleteCount; k++) {
        from = actualStart + k;
        if (from in O) createProperty(A, k, O[from]);
      }
      A.length = actualDeleteCount;
      if (insertCount < actualDeleteCount) {
        for (k = actualStart; k < len - actualDeleteCount; k++) {
          from = k + actualDeleteCount;
          to = k + insertCount;
          if (from in O) O[to] = O[from];
          else delete O[to];
        }
        for (k = len; k > len - actualDeleteCount + insertCount; k--) delete O[k - 1];
      } else if (insertCount > actualDeleteCount) {
        for (k = len - actualDeleteCount; k > actualStart; k--) {
          from = k + actualDeleteCount - 1;
          to = k + insertCount - 1;
          if (from in O) O[to] = O[from];
          else delete O[to];
        }
      }
      for (k = 0; k < insertCount; k++) {
        O[k + actualStart] = arguments[k + 2];
      }
      O.length = len - actualDeleteCount + insertCount;
      return A;
    }
  });

  var $indexOf = arrayIncludes.indexOf;


  var nativeIndexOf = [].indexOf;

  var NEGATIVE_ZERO = !!nativeIndexOf && 1 / [1].indexOf(1, -0) < 0;
  var STRICT_METHOD = arrayMethodIsStrict('indexOf');

  // `Array.prototype.indexOf` method
  // https://tc39.es/ecma262/#sec-array.prototype.indexof
  _export({ target: 'Array', proto: true, forced: NEGATIVE_ZERO || !STRICT_METHOD }, {
    indexOf: function indexOf(searchElement /* , fromIndex = 0 */) {
      return NEGATIVE_ZERO
        // convert -0 to +0
        ? nativeIndexOf.apply(this, arguments) || 0
        : $indexOf(this, searchElement, arguments.length > 1 ? arguments[1] : undefined);
    }
  });

  // a string of all valid unicode whitespaces
  var whitespaces = '\u0009\u000A\u000B\u000C\u000D\u0020\u00A0\u1680\u2000\u2001\u2002' +
    '\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028\u2029\uFEFF';

  var whitespace = '[' + whitespaces + ']';
  var ltrim = RegExp('^' + whitespace + whitespace + '*');
  var rtrim = RegExp(whitespace + whitespace + '*$');

  // `String.prototype.{ trim, trimStart, trimEnd, trimLeft, trimRight }` methods implementation
  var createMethod = function (TYPE) {
    return function ($this) {
      var string = String(requireObjectCoercible($this));
      if (TYPE & 1) string = string.replace(ltrim, '');
      if (TYPE & 2) string = string.replace(rtrim, '');
      return string;
    };
  };

  var stringTrim = {
    // `String.prototype.{ trimLeft, trimStart }` methods
    // https://tc39.es/ecma262/#sec-string.prototype.trimstart
    start: createMethod(1),
    // `String.prototype.{ trimRight, trimEnd }` methods
    // https://tc39.es/ecma262/#sec-string.prototype.trimend
    end: createMethod(2),
    // `String.prototype.trim` method
    // https://tc39.es/ecma262/#sec-string.prototype.trim
    trim: createMethod(3)
  };

  var trim = stringTrim.trim;


  var $parseFloat = global_1.parseFloat;
  var FORCED = 1 / $parseFloat(whitespaces + '-0') !== -Infinity;

  // `parseFloat` method
  // https://tc39.es/ecma262/#sec-parsefloat-string
  var numberParseFloat = FORCED ? function parseFloat(string) {
    var trimmedString = trim(String(string));
    var result = $parseFloat(trimmedString);
    return result === 0 && trimmedString.charAt(0) == '-' ? -0 : result;
  } : $parseFloat;

  // `parseFloat` method
  // https://tc39.es/ecma262/#sec-parsefloat-string
  _export({ global: true, forced: parseFloat != numberParseFloat }, {
    parseFloat: numberParseFloat
  });

  var TO_STRING_TAG$1 = wellKnownSymbol('toStringTag');
  var test = {};

  test[TO_STRING_TAG$1] = 'z';

  var toStringTagSupport = String(test) === '[object z]';

  var TO_STRING_TAG = wellKnownSymbol('toStringTag');
  // ES3 wrong here
  var CORRECT_ARGUMENTS = classofRaw(function () { return arguments; }()) == 'Arguments';

  // fallback for IE11 Script Access Denied error
  var tryGet = function (it, key) {
    try {
      return it[key];
    } catch (error) { /* empty */ }
  };

  // getting tag from ES6+ `Object.prototype.toString`
  var classof = toStringTagSupport ? classofRaw : function (it) {
    var O, tag, result;
    return it === undefined ? 'Undefined' : it === null ? 'Null'
      // @@toStringTag case
      : typeof (tag = tryGet(O = Object(it), TO_STRING_TAG)) == 'string' ? tag
      // builtinTag case
      : CORRECT_ARGUMENTS ? classofRaw(O)
      // ES3 arguments fallback
      : (result = classofRaw(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : result;
  };

  // `Object.prototype.toString` method implementation
  // https://tc39.es/ecma262/#sec-object.prototype.tostring
  var objectToString = toStringTagSupport ? {}.toString : function toString() {
    return '[object ' + classof(this) + ']';
  };

  // `Object.prototype.toString` method
  // https://tc39.es/ecma262/#sec-object.prototype.tostring
  if (!toStringTagSupport) {
    redefine(Object.prototype, 'toString', objectToString, { unsafe: true });
  }

  // `RegExp.prototype.flags` getter implementation
  // https://tc39.es/ecma262/#sec-get-regexp.prototype.flags
  var regexpFlags = function () {
    var that = anObject(this);
    var result = '';
    if (that.global) result += 'g';
    if (that.ignoreCase) result += 'i';
    if (that.multiline) result += 'm';
    if (that.dotAll) result += 's';
    if (that.unicode) result += 'u';
    if (that.sticky) result += 'y';
    return result;
  };

  var TO_STRING = 'toString';
  var RegExpPrototype = RegExp.prototype;
  var nativeToString = RegExpPrototype[TO_STRING];

  var NOT_GENERIC = fails(function () { return nativeToString.call({ source: 'a', flags: 'b' }) != '/a/b'; });
  // FF44- RegExp#toString has a wrong name
  var INCORRECT_NAME = nativeToString.name != TO_STRING;

  // `RegExp.prototype.toString` method
  // https://tc39.es/ecma262/#sec-regexp.prototype.tostring
  if (NOT_GENERIC || INCORRECT_NAME) {
    redefine(RegExp.prototype, TO_STRING, function toString() {
      var R = anObject(this);
      var p = String(R.source);
      var rf = R.flags;
      var f = String(rf === undefined && R instanceof RegExp && !('flags' in RegExpPrototype) ? regexpFlags.call(R) : rf);
      return '/' + p + '/' + f;
    }, { unsafe: true });
  }

  /**
   * @author Nadim Basalamah <dimbslmh@gmail.com>
   * @version: v1.1.0
   * https://github.com/dimbslmh/bootstrap-table/tree/master/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js
   * Modification: ErwannNevou <https://github.com/ErwannNevou>
   */

  var isSingleSort = false;
  var Utils = $__default['default'].fn.bootstrapTable.utils;
  $__default['default'].extend($__default['default'].fn.bootstrapTable.defaults.icons, {
    plus: {
      bootstrap3: 'glyphicon-plus',
      bootstrap4: 'fa-plus',
      bootstrap5: 'fa-plus',
      semantic: 'fa-plus',
      materialize: 'plus',
      foundation: 'fa-plus',
      bulma: 'fa-plus',
      'bootstrap-table': 'icon-plus'
    }[$__default['default'].fn.bootstrapTable.theme] || 'fa-clock',
    minus: {
      bootstrap3: 'glyphicon-minus',
      bootstrap4: 'fa-minus',
      bootstrap5: 'fa-minus',
      semantic: 'fa-minus',
      materialize: 'minus',
      foundation: 'fa-minus',
      bulma: 'fa-minus',
      'bootstrap-table': 'icon-minus'
    }[$__default['default'].fn.bootstrapTable.theme] || 'fa-clock',
    sort: {
      bootstrap3: 'glyphicon-sort',
      bootstrap4: 'fa-sort',
      bootstrap5: 'fa-sort',
      semantic: 'fa-sort',
      materialize: 'sort',
      foundation: 'fa-sort',
      bulma: 'fa-sort',
      'bootstrap-table': 'icon-sort-amount-asc'
    }[$__default['default'].fn.bootstrapTable.theme] || 'fa-clock'
  });
  var theme = {
    bootstrap3: {
      html: {
        multipleSortModal: "\n        <div class=\"modal fade\" id=\"%s\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n        <div class=\"modal-dialog\">\n            <div class=\"modal-content\">\n                <div class=\"modal-header\">\n                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n                     <h4 class=\"modal-title\" id=\"%sLabel\">%s</h4>\n                </div>\n                <div class=\"modal-body\">\n                    <div class=\"bootstrap-table\">\n                        <div class=\"fixed-table-toolbar\">\n                            <div class=\"bars\">\n                                <div id=\"toolbar\">\n                                     <button id=\"add\" type=\"button\" class=\"btn btn-default\">%s %s</button>\n                                     <button id=\"delete\" type=\"button\" class=\"btn btn-default\" disabled>%s %s</button>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"fixed-table-container\">\n                            <table id=\"multi-sort\" class=\"table\">\n                                <thead>\n                                    <tr>\n                                        <th></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                    </tr>\n                                </thead>\n                                <tbody></tbody>\n                            </table>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"modal-footer\">\n                     <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">%s</button>\n                     <button type=\"button\" class=\"btn-blue multi-sort-order-button\">%s</button>\n                </div>\n            </div>\n        </div>\n    </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s form-control">'
      }
    },
    bootstrap4: {
      html: {
        multipleSortModal: "\n        <div class=\"modal fade\" id=\"%s\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-dialog\" role=\"document\">\n            <div class=\"modal-content\">\n              <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"%sLabel\">%s</h5>\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n                  <span aria-hidden=\"true\">&times;</span>\n                </button>\n              </div>\n              <div class=\"modal-body\">\n                <div class=\"bootstrap-table\">\n                        <div class=\"fixed-table-toolbar\">\n                            <div class=\"bars\">\n                                <div id=\"toolbar\" class=\"pb-3\">\n                                     <button id=\"add\" type=\"button\" class=\"btn btn-secondary\">%s %s</button>\n                                     <button id=\"delete\" type=\"button\" class=\"btn btn-secondary\" disabled>%s %s</button>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"fixed-table-container\">\n                            <table id=\"multi-sort\" class=\"table\">\n                                <thead>\n                                    <tr>\n                                        <th></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                    </tr>\n                                </thead>\n                                <tbody></tbody>\n                            </table>\n                        </div>\n                    </div>\n              </div>\n              <div class=\"modal-footer\">\n                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">%s</button>\n                <button type=\"button\" class=\"btn-blue multi-sort-order-button\">%s</button>\n              </div>\n            </div>\n          </div>\n        </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s form-control">'
      }
    },
    bootstrap5: {
      html: {
        multipleSortModal: "\n        <div class=\"modal fade\" id=\"%s\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-dialog\" role=\"document\">\n            <div class=\"modal-content\">\n              <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"%sLabel\">%s</h5>\n                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>\n              </div>\n              <div class=\"modal-body\">\n                <div class=\"bootstrap-table\">\n                        <div class=\"fixed-table-toolbar\">\n                            <div class=\"bars\">\n                                <div id=\"toolbar\" class=\"pb-3\">\n                                     <button id=\"add\" type=\"button\" class=\"btn btn-secondary\">%s %s</button>\n                                     <button id=\"delete\" type=\"button\" class=\"btn btn-secondary\" disabled>%s %s</button>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"fixed-table-container\">\n                            <table id=\"multi-sort\" class=\"table\">\n                                <thead>\n                                    <tr>\n                                        <th></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                    </tr>\n                                </thead>\n                                <tbody></tbody>\n                            </table>\n                        </div>\n                    </div>\n              </div>\n              <div class=\"modal-footer\">\n                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">%s</button>\n                <button type=\"button\" class=\"btn-blue multi-sort-order-button\">%s</button>\n              </div>\n            </div>\n          </div>\n        </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" type="button" data-bs-toggle="modal" data-bs-target="#%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s form-control">'
      }
    },
    semantic: {
      html: {
        multipleSortModal: "\n        <div class=\"ui modal tiny\" id=\"%s\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n        <i class=\"close icon\"></i>\n        <div class=\"header\" id=\"%sLabel\">\n          %s\n        </div>\n        <div class=\"image content\">\n          <div class=\"bootstrap-table\">\n            <div class=\"fixed-table-toolbar\">\n                <div class=\"bars\">\n                  <div id=\"toolbar\" class=\"pb-3\">\n                    <button id=\"add\" type=\"button\" class=\"ui button\">%s %s</button>\n                    <button id=\"delete\" type=\"button\" class=\"ui button\" disabled>%s %s</button>\n                  </div>\n                </div>\n            </div>\n            <div class=\"fixed-table-container\">\n                <table id=\"multi-sort\" class=\"table\">\n                    <thead>\n                        <tr>\n                            <th></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                        </tr>\n                    </thead>\n                    <tbody></tbody>\n                </table>\n            </div>\n          </div>\n        </div>\n        <div class=\"actions\">\n          <div class=\"ui button deny\">%s</div>\n          <div class=\"ui button approve multi-sort-order-button\">%s</div>\n        </div>\n      </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s">'
      }
    },
    materialize: {
      html: {
        multipleSortModal: "\n        <div id=\"%s\" class=\"modal\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-content\" id=\"%sLabel\">\n            <h4>%s</h4>\n            <div class=\"bootstrap-table\">\n            <div class=\"fixed-table-toolbar\">\n                <div class=\"bars\">\n                  <div id=\"toolbar\" class=\"pb-3\">\n                    <button id=\"add\" type=\"button\" class=\"waves-effect waves-light btn\">%s %s</button>\n                    <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light btn\" disabled>%s %s</button>\n                  </div>\n                </div>\n            </div>\n            <div class=\"fixed-table-container\">\n                <table id=\"multi-sort\" class=\"table\">\n                    <thead>\n                        <tr>\n                            <th></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                        </tr>\n                    </thead>\n                    <tbody></tbody>\n                </table>\n            </div>\n          </div>\n          <div class=\"modal-footer\">\n            <a href=\"javascript:void(0)\" class=\"modal-close waves-effect waves-light btn\">%s</a>\n            <a href=\"javascript:void(0)\" class=\"modal-close waves-effect waves-light btn multi-sort-order-button\">%s</a>\n          </div>\n          </div>\n        </div>\n      ",
        multipleSortButton: '<a class="multi-sort %s modal-trigger" href="#%s" type="button" data-toggle="modal" title="%s">%s</a>',
        multipleSortSelect: '<select class="%s %s browser-default">'
      }
    },
    foundation: {
      html: {
        multipleSortModal: "\n        <div class=\"reveal\" id=\"%s\" data-reveal aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n            <div id=\"%sLabel\">\n              <h1>%s</h1>\n              <div class=\"bootstrap-table\">\n                <div class=\"fixed-table-toolbar\">\n                    <div class=\"bars\">\n                      <div id=\"toolbar\" class=\"padding-bottom-2\">\n                        <button id=\"add\" type=\"button\" class=\"waves-effect waves-light button\">%s %s</button>\n                        <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light button\" disabled>%s %s</button>\n                      </div>\n                    </div>\n                </div>\n                <div class=\"fixed-table-container\">\n                    <table id=\"multi-sort\" class=\"table\">\n                        <thead>\n                            <tr>\n                                <th></th>\n                                <th><div class=\"th-inner\">%s</div></th>\n                                <th><div class=\"th-inner\">%s</div></th>\n                            </tr>\n                        </thead>\n                        <tbody></tbody>\n                    </table>\n                </div>\n              </div>\n\n              <button class=\"waves-effect waves-light button\" data-close aria-label=\"Close modal\" type=\"button\">\n                <span aria-hidden=\"true\">%s</span>\n              </button>\n              <button class=\"waves-effect waves-light button multi-sort-order-button\" data-close aria-label=\"Order\" type=\"button\">\n                  <span aria-hidden=\"true\">%s</span>\n              </button>\n            </div>\n        </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" data-open="%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s browser-default">'
      }
    },
    bulma: {
      html: {
        multipleSortModal: "\n        <div class=\"modal\" id=\"%s\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-background\"></div>\n          <div class=\"modal-content\" id=\"%sLabel\">\n            <div class=\"box\">\n            <h2>%s</h2>\n              <div class=\"bootstrap-table\">\n                  <div class=\"fixed-table-toolbar\">\n                      <div class=\"bars\">\n                        <div id=\"toolbar\" class=\"padding-bottom-2\">\n                          <button id=\"add\" type=\"button\" class=\"waves-effect waves-light button\">%s %s</button>\n                          <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light button\" disabled>%s %s</button>\n                        </div>\n                      </div>\n                  </div>\n                  <div class=\"fixed-table-container\">\n                      <table id=\"multi-sort\" class=\"table\">\n                          <thead>\n                              <tr>\n                                  <th></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                              </tr>\n                          </thead>\n                          <tbody></tbody>\n                      </table>\n                    </div>\n                </div>\n                <button type=\"button\" class=\"waves-effect waves-light button\" data-close>%s</button>\n                <button type=\"button\" class=\"waves-effect waves-light button multi-sort-order-button\" data-close>%s</button>\n            </div>\n          </div>\n        </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" data-target="%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s browser-default">'
      }
    },
    'bootstrap-table': {
      html: {
        multipleSortModal: "\n        <div class=\"modal\" id=\"%s\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-background\"></div>\n          <div class=\"modal-content\" id=\"%sLabel\">\n            <div class=\"box\">\n            <h2>%s</h2>\n              <div class=\"bootstrap-table\">\n                  <div class=\"fixed-table-toolbar\">\n                      <div class=\"bars\">\n                        <div id=\"toolbar\" class=\"padding-bottom-2\">\n                          <button id=\"add\" type=\"button\" class=\"btn\">%s %s</button>\n                          <button id=\"delete\" type=\"button\" class=\"btn\" disabled>%s %s</button>\n                        </div>\n                      </div>\n                  </div>\n                  <div class=\"fixed-table-container\">\n                      <table id=\"multi-sort\" class=\"table\">\n                          <thead>\n                              <tr>\n                                  <th></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                              </tr>\n                          </thead>\n                          <tbody></tbody>\n                      </table>\n                    </div>\n                </div>\n                <div class=\"mt-30\">\n                    <button type=\"button\" class=\"btn\" data-close>%s</button>\n                    <button type=\"button\" class=\"btn multi-sort-order-button\" data-close>%s</button>\n                </div>\n            </div>\n          </div>\n        </div>\n      ",
        multipleSortButton: '<button class="multi-sort %s" data-target="%s" title="%s">%s</button>',
        multipleSortSelect: '<select class="%s %s browser-default">'
      }
    }
  }[$__default['default'].fn.bootstrapTable.theme];

  var showSortModal = function showSortModal(that) {
    var _selector = that.sortModalSelector;

    var _id = "#".concat(_selector);

    var o = that.options;

    if (!$__default['default'](_id).hasClass('modal')) {
      var sModal = Utils.sprintf(theme.html.multipleSortModal, _selector, _selector, _selector, that.options.formatMultipleSort(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, o.icons.plus), that.options.formatAddLevel(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, o.icons.minus), that.options.formatDeleteLevel(), that.options.formatColumn(), that.options.formatOrder(), that.options.formatCancel(), that.options.formatSort());
      $__default['default']('body').append($__default['default'](sModal));
      that.$sortModal = $__default['default'](_id);
      var $rows = that.$sortModal.find('tbody > tr');
      that.$sortModal.off('click', '#add').on('click', '#add', function () {
        var total = that.$sortModal.find('.multi-sort-name:first option').length;
        var current = that.$sortModal.find('tbody tr').length;

        if (current < total) {
          current++;
          that.addLevel();
          that.setButtonStates();
        }
      });
      that.$sortModal.off('click', '#delete').on('click', '#delete', function () {
        var total = that.$sortModal.find('.multi-sort-name:first option').length;
        var current = that.$sortModal.find('tbody tr').length;

        if (current > 1 && current <= total) {
          current--;
          that.$sortModal.find('tbody tr:last').remove();
          that.setButtonStates();
        }
      });
      that.$sortModal.off('click', '.multi-sort-order-button').on('click', '.multi-sort-order-button', function () {
        var $rows = that.$sortModal.find('tbody > tr');
        var $alert = that.$sortModal.find('div.alert');
        var fields = [];
        var results = [];
        var sortPriority = $__default['default'].map($rows, function (row) {
          var $row = $__default['default'](row);
          var name = $row.find('.multi-sort-name').val();
          var order = $row.find('.multi-sort-order').val();
          fields.push(name);
          return {
            sortName: name,
            sortOrder: order
          };
        });
        var sorted_fields = fields.sort();

        for (var i = 0; i < fields.length - 1; i++) {
          if (sorted_fields[i + 1] === sorted_fields[i]) {
            results.push(sorted_fields[i]);
          }
        }

        if (results.length > 0) {
          if ($alert.length === 0) {
            $alert = "<div class=\"alert alert-danger\" role=\"alert\"><strong>".concat(that.options.formatDuplicateAlertTitle(), "</strong> ").concat(that.options.formatDuplicateAlertDescription(), "</div>");
            $__default['default']($alert).insertBefore(that.$sortModal.find('.bars'));
          }
        } else {
          if ($alert.length === 1) {
            $__default['default']($alert).remove();
          }

          if ($__default['default'].inArray($__default['default'].fn.bootstrapTable.theme, ['bootstrap3', 'bootstrap4']) !== -1) {
            that.$sortModal.modal('hide');
          }

          that.multiSort(sortPriority);
        }
      });

      if (that.options.sortPriority === null || that.options.sortPriority.length === 0) {
        if (that.options.sortName) {
          that.options.sortPriority = [{
            sortName: that.options.sortName,
            sortOrder: that.options.sortOrder
          }];
        }
      }

      if (that.options.sortPriority !== null && that.options.sortPriority.length > 0) {
        if ($rows.length < that.options.sortPriority.length && _typeof(that.options.sortPriority) === 'object') {
          for (var i = 0; i < that.options.sortPriority.length; i++) {
            that.addLevel(i, that.options.sortPriority[i]);
          }
        }
      } else {
        that.addLevel(0);
      }

      that.setButtonStates();
    }
  };

  $__default['default'].fn.bootstrapTable.methods.push('multipleSort');
  $__default['default'].fn.bootstrapTable.methods.push('multiSort');
  $__default['default'].extend($__default['default'].fn.bootstrapTable.defaults, {
    showMultiSort: false,
    showMultiSortButton: true,
    multiSortStrictSort: false,
    sortPriority: null,
    onMultipleSort: function onMultipleSort() {
      return false;
    }
  });
  $__default['default'].extend($__default['default'].fn.bootstrapTable.Constructor.EVENTS, {
    'multiple-sort.bs.table': 'onMultipleSort'
  });
  $__default['default'].extend($__default['default'].fn.bootstrapTable.locales, {
    formatMultipleSort: function formatMultipleSort() {
      return 'Multiple Sort';
    },
    formatAddLevel: function formatAddLevel() {
      return 'Add Level';
    },
    formatDeleteLevel: function formatDeleteLevel() {
      return 'Delete Level';
    },
    formatColumn: function formatColumn() {
      return 'Column';
    },
    formatOrder: function formatOrder() {
      return 'Order';
    },
    formatSortBy: function formatSortBy() {
      return 'Sort by';
    },
    formatThenBy: function formatThenBy() {
      return 'Then by';
    },
    formatSort: function formatSort() {
      return 'Sort';
    },
    formatCancel: function formatCancel() {
      return 'Cancel';
    },
    formatDuplicateAlertTitle: function formatDuplicateAlertTitle() {
      return 'Duplicate(s) detected!';
    },
    formatDuplicateAlertDescription: function formatDuplicateAlertDescription() {
      return 'Please remove or change any duplicate column.';
    },
    formatSortOrders: function formatSortOrders() {
      return {
        asc: 'Ascending',
        desc: 'Descending'
      };
    }
  });
  $__default['default'].extend($__default['default'].fn.bootstrapTable.defaults, $__default['default'].fn.bootstrapTable.locales);
  var BootstrapTable = $__default['default'].fn.bootstrapTable.Constructor;
  var _initToolbar = BootstrapTable.prototype.initToolbar;
  var _destroy = BootstrapTable.prototype.destroy;

  BootstrapTable.prototype.initToolbar = function () {
    var _this = this;

    this.showToolbar = this.showToolbar || this.options.showMultiSort;
    var that = this;
    var sortModalSelector = "sortModal_".concat(this.$el.attr('id'));
    var sortModalId = "#".concat(sortModalSelector);
    var $multiSortBtn = this.$toolbar.find('div.multi-sort');
    var o = this.options;
    this.$sortModal = $__default['default'](sortModalId);
    this.sortModalSelector = sortModalSelector;

    if (that.options.sortPriority !== null) {
      that.onMultipleSort();
    }

    if (this.options.showMultiSortButton) {
      this.buttons = Object.assign(this.buttons, {
        multipleSort: {
          html: Utils.sprintf(theme.html.multipleSortButton, that.constants.buttonsClass, that.sortModalSelector, this.options.formatMultipleSort(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, o.icons.sort))
        }
      });
    }

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _initToolbar.apply(this, Array.prototype.slice.apply(args));

    if (that.options.sidePagination === 'server' && !isSingleSort && that.options.sortPriority !== null) {
      var t = that.options.queryParams;

      that.options.queryParams = function (params) {
        params.multiSort = that.options.sortPriority;
        return t(params);
      };
    }

    if (this.options.showMultiSort) {
      if (!$multiSortBtn.length && this.options.showMultiSortButton) {
        if ($__default['default'].fn.bootstrapTable.theme === 'semantic') {
          this.$toolbar.find('.multi-sort').on('click', function () {
            $__default['default'](sortModalId).modal('show');
          });
        } else if ($__default['default'].fn.bootstrapTable.theme === 'materialize') {
          this.$toolbar.find('.multi-sort').on('click', function () {
            $__default['default'](sortModalId).modal();
          });
        } else if ($__default['default'].fn.bootstrapTable.theme === 'bootstrap-table') {
          this.$toolbar.find('.multi-sort').on('click', function () {
            $__default['default'](sortModalId).addClass('show');
          });
        } else if ($__default['default'].fn.bootstrapTable.theme === 'foundation') {
          this.$toolbar.find('.multi-sort').on('click', function () {
            if (!_this.foundationModal) {
              // eslint-disable-next-line no-undef
              _this.foundationModal = new Foundation.Reveal($__default['default'](sortModalId));
            }

            _this.foundationModal.open();
          });
        } else if ($__default['default'].fn.bootstrapTable.theme === 'bulma') {
          this.$toolbar.find('.multi-sort').on('click', function () {
            $__default['default']('html').toggleClass('is-clipped');
            $__default['default'](sortModalId).toggleClass('is-active');
            $__default['default']('button[data-close]').one('click', function () {
              $__default['default']('html').toggleClass('is-clipped');
              $__default['default'](sortModalId).toggleClass('is-active');
            });
          });
        }

        showSortModal(that);
      }

      this.$el.on('sort.bs.table', function () {
        isSingleSort = true;
      });
      this.$el.on('multiple-sort.bs.table', function () {
        isSingleSort = false;
      });
      this.$el.on('load-success.bs.table', function () {
        if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object' && that.options.sidePagination !== 'server') {
          that.onMultipleSort();
        }
      });
      this.$el.on('column-switch.bs.table', function (field, checked) {
        for (var i = 0; i < that.options.sortPriority.length; i++) {
          if (that.options.sortPriority[i].sortName === checked) {
            that.options.sortPriority.splice(i, 1);
          }
        }

        that.assignSortableArrows();
        that.$sortModal.remove();
        showSortModal(that);
      });
      this.$el.on('reset-view.bs.table', function () {
        if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object') {
          that.assignSortableArrows();
        }
      });
    }
  };

  BootstrapTable.prototype.destroy = function () {
    for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args[_key2] = arguments[_key2];
    }

    _destroy.apply(this, Array.prototype.slice.apply(args));

    if (this.options.showMultiSort) {
      this.enableCustomSort = false;
      this.$sortModal.remove();
    }
  };

  BootstrapTable.prototype.multipleSort = function () {
    var that = this;

    if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object' && that.options.sidePagination !== 'server') {
      that.onMultipleSort();
    }
  };

  BootstrapTable.prototype.onMultipleSort = function () {
    var that = this;

    var cmp = function cmp(x, y) {
      return x > y ? 1 : x < y ? -1 : 0;
    };

    var arrayCmp = function arrayCmp(a, b) {
      var arr1 = [];
      var arr2 = [];

      for (var i = 0; i < that.options.sortPriority.length; i++) {
        var fieldName = that.options.sortPriority[i].sortName;
        var fieldIndex = that.header.fields.indexOf(fieldName);
        var sorterName = that.header.sorters[that.header.fields.indexOf(fieldName)];

        if (that.header.sortNames[fieldIndex]) {
          fieldName = that.header.sortNames[fieldIndex];
        }

        var order = that.options.sortPriority[i].sortOrder === 'desc' ? -1 : 1;
        var aa = Utils.getItemField(a, fieldName);
        var bb = Utils.getItemField(b, fieldName);
        var value1 = $__default['default'].fn.bootstrapTable.utils.calculateObjectValue(that.header, sorterName, [aa, bb]);
        var value2 = $__default['default'].fn.bootstrapTable.utils.calculateObjectValue(that.header, sorterName, [bb, aa]);

        if (value1 !== undefined && value2 !== undefined) {
          arr1.push(order * value1);
          arr2.push(order * value2);
          continue;
        }

        if (aa === undefined || aa === null) aa = '';
        if (bb === undefined || bb === null) bb = '';

        if ($__default['default'].isNumeric(aa) && $__default['default'].isNumeric(bb)) {
          aa = parseFloat(aa);
          bb = parseFloat(bb);
        } else {
          aa = aa.toString();
          bb = bb.toString();

          if (that.options.multiSortStrictSort) {
            aa = aa.toLowerCase();
            bb = bb.toLowerCase();
          }
        }

        arr1.push(order * cmp(aa, bb));
        arr2.push(order * cmp(bb, aa));
      }

      return cmp(arr1, arr2);
    };

    this.enableCustomSort = true;
    this.data.sort(function (a, b) {
      return arrayCmp(a, b);
    });
    this.initBody();
    this.assignSortableArrows();
    this.trigger('multiple-sort');
  };

  BootstrapTable.prototype.addLevel = function (index, sortPriority) {
    var text = index === 0 ? this.options.formatSortBy() : this.options.formatThenBy();
    this.$sortModal.find('tbody').append($__default['default']('<tr>').append($__default['default']('<td>').text(text)).append($__default['default']('<td>').append($__default['default'](Utils.sprintf(theme.html.multipleSortSelect, this.constants.classes.paginationDropdown, 'multi-sort-name')))).append($__default['default']('<td>').append($__default['default'](Utils.sprintf(theme.html.multipleSortSelect, this.constants.classes.paginationDropdown, 'multi-sort-order')))));
    var $multiSortName = this.$sortModal.find('.multi-sort-name').last();
    var $multiSortOrder = this.$sortModal.find('.multi-sort-order').last();
    $__default['default'].each(this.columns, function (i, column) {
      if (column.sortable === false || column.visible === false) {
        return true;
      }

      $multiSortName.append("<option value=\"".concat(column.field, "\">").concat(column.title, "</option>"));
    });
    $__default['default'].each(this.options.formatSortOrders(), function (value, order) {
      $multiSortOrder.append("<option value=\"".concat(value, "\">").concat(order, "</option>"));
    });

    if (sortPriority !== undefined) {
      $multiSortName.find("option[value=\"".concat(sortPriority.sortName, "\"]")).attr('selected', true);
      $multiSortOrder.find("option[value=\"".concat(sortPriority.sortOrder, "\"]")).attr('selected', true);
    }
  };

  BootstrapTable.prototype.assignSortableArrows = function () {
    var that = this;
    var headers = that.$header.find('th');

    for (var i = 0; i < headers.length; i++) {
      for (var c = 0; c < that.options.sortPriority.length; c++) {
        if ($__default['default'](headers[i]).data('field') === that.options.sortPriority[c].sortName) {
          $__default['default'](headers[i]).find('.sortable').removeClass('desc asc').addClass(that.options.sortPriority[c].sortOrder);
        }
      }
    }
  };

  BootstrapTable.prototype.setButtonStates = function () {
    var total = this.$sortModal.find('.multi-sort-name:first option').length;
    var current = this.$sortModal.find('tbody tr').length;

    if (current === total) {
      this.$sortModal.find('#add').attr('disabled', 'disabled');
    }

    if (current > 1) {
      this.$sortModal.find('#delete').removeAttr('disabled');
    }

    if (current < total) {
      this.$sortModal.find('#add').removeAttr('disabled');
    }

    if (current === 1) {
      this.$sortModal.find('#delete').attr('disabled', 'disabled');
    }
  };

  BootstrapTable.prototype.multiSort = function (sortPriority) {
    var _this2 = this;

    this.options.sortPriority = sortPriority;
    this.options.sortName = undefined;

    if (this.options.sidePagination === 'server') {
      var queryParams = this.options.queryParams;

      this.options.queryParams = function (params) {
        params.multiSort = _this2.options.sortPriority;
        return $__default['default'].fn.bootstrapTable.utils.calculateObjectValue(_this2.options, queryParams, [params]);
      };

      isSingleSort = false;
      this.initServer(this.options.silentSort);
      return;
    }

    this.onMultipleSort();
  };

})));
