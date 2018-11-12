var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.10
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
(function (root, factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([], factory);
    } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
        module.exports = factory();
    } else {
        root.Lang = factory();
    }
})(this, function () {
    "use strict";
    function inferLocale() {
        if (typeof document !== "undefined" && document.documentElement) {
            return document.documentElement.lang;
        }
    }function convertNumber(str) {
        if (str === "-Inf") {
            return -Infinity;
        } else if (str === "+Inf" || str === "Inf" || str === "*") {
            return Infinity;
        }return parseInt(str, 10);
    }var intervalRegexp = /^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])$/;var anyIntervalRegexp = /({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])/;var defaults = { locale: "en" };var Lang = function Lang(options) {
        options = options || {};this.locale = options.locale || inferLocale() || defaults.locale;this.fallback = options.fallback;this.messages = options.messages;
    };Lang.prototype.setMessages = function (messages) {
        this.messages = messages;
    };Lang.prototype.getLocale = function () {
        return this.locale || this.fallback;
    };Lang.prototype.setLocale = function (locale) {
        this.locale = locale;
    };Lang.prototype.getFallback = function () {
        return this.fallback;
    };Lang.prototype.setFallback = function (fallback) {
        this.fallback = fallback;
    };Lang.prototype.has = function (key, locale) {
        if (typeof key !== "string" || !this.messages) {
            return false;
        }return this._getMessage(key, locale) !== null;
    };Lang.prototype.get = function (key, replacements, locale) {
        if (!this.has(key, locale)) {
            return key;
        }var message = this._getMessage(key, locale);if (message === null) {
            return key;
        }if (replacements) {
            message = this._applyReplacements(message, replacements);
        }return message;
    };Lang.prototype.trans = function (key, replacements) {
        return this.get(key, replacements);
    };Lang.prototype.choice = function (key, number, replacements, locale) {
        replacements = typeof replacements !== "undefined" ? replacements : {};replacements.count = number;var message = this.get(key, replacements, locale);if (message === null || message === undefined) {
            return message;
        }var messageParts = message.split("|");var explicitRules = [];for (var i = 0; i < messageParts.length; i++) {
            messageParts[i] = messageParts[i].trim();if (anyIntervalRegexp.test(messageParts[i])) {
                var messageSpaceSplit = messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i] = messageSpaceSplit.join(" ");
            }
        }if (messageParts.length === 1) {
            return message;
        }for (var j = 0; j < explicitRules.length; j++) {
            if (this._testInterval(number, explicitRules[j])) {
                return messageParts[j];
            }
        }var pluralForm = this._getPluralForm(number);return messageParts[pluralForm];
    };Lang.prototype.transChoice = function (key, count, replacements) {
        return this.choice(key, count, replacements);
    };Lang.prototype._parseKey = function (key, locale) {
        if (typeof key !== "string" || typeof locale !== "string") {
            return null;
        }var segments = key.split(".");var source = segments[0].replace(/\//g, ".");return { source: locale + "." + source, sourceFallback: this.getFallback() + "." + source, entries: segments.slice(1) };
    };Lang.prototype._getMessage = function (key, locale) {
        locale = locale || this.getLocale();key = this._parseKey(key, locale);if (this.messages[key.source] === undefined && this.messages[key.sourceFallback] === undefined) {
            return null;
        }var message = this.messages[key.source];var entries = key.entries.slice();var subKey = "";while (entries.length && message !== undefined) {
            var subKey = !subKey ? entries.shift() : subKey.concat(".", entries.shift());if (message[subKey] !== undefined) {
                message = message[subKey];subKey = "";
            }
        }if (typeof message !== "string" && this.messages[key.sourceFallback]) {
            message = this.messages[key.sourceFallback];entries = key.entries.slice();subKey = "";while (entries.length && message !== undefined) {
                var subKey = !subKey ? entries.shift() : subKey.concat(".", entries.shift());if (message[subKey]) {
                    message = message[subKey];subKey = "";
                }
            }
        }if (typeof message !== "string") {
            return null;
        }return message;
    };Lang.prototype._findMessageInTree = function (pathSegments, tree) {
        while (pathSegments.length && tree !== undefined) {
            var dottedKey = pathSegments.join(".");if (tree[dottedKey]) {
                tree = tree[dottedKey];break;
            }tree = tree[pathSegments.shift()];
        }return tree;
    };Lang.prototype._applyReplacements = function (message, replacements) {
        for (var replace in replacements) {
            message = message.replace(new RegExp(":" + replace, "gi"), function (match) {
                var value = replacements[replace];var allCaps = match === match.toUpperCase();if (allCaps) {
                    return value.toUpperCase();
                }var firstCap = match === match.replace(/\w/i, function (letter) {
                    return letter.toUpperCase();
                });if (firstCap) {
                    return value.charAt(0).toUpperCase() + value.slice(1);
                }return value;
            });
        }return message;
    };Lang.prototype._testInterval = function (count, interval) {
        if (typeof interval !== "string") {
            throw "Invalid interval: should be a string.";
        }interval = interval.trim();var matches = interval.match(intervalRegexp);if (!matches) {
            throw "Invalid interval: " + interval;
        }if (matches[2]) {
            var items = matches[2].split(",");for (var i = 0; i < items.length; i++) {
                if (parseInt(items[i], 10) === count) {
                    return true;
                }
            }
        } else {
            matches = matches.filter(function (match) {
                return !!match;
            });var leftDelimiter = matches[1];var leftNumber = convertNumber(matches[2]);if (leftNumber === Infinity) {
                leftNumber = -Infinity;
            }var rightNumber = convertNumber(matches[3]);var rightDelimiter = matches[4];return (leftDelimiter === "[" ? count >= leftNumber : count > leftNumber) && (rightDelimiter === "]" ? count <= rightNumber : count < rightNumber);
        }return false;
    };Lang.prototype._getPluralForm = function (count) {
        switch (this.locale) {case "az":case "bo":case "dz":case "id":case "ja":case "jv":case "ka":case "km":case "kn":case "ko":case "ms":case "th":case "tr":case "vi":case "zh":
                return 0;case "af":case "bn":case "bg":case "ca":case "da":case "de":case "el":case "en":case "eo":case "es":case "et":case "eu":case "fa":case "fi":case "fo":case "fur":case "fy":case "gl":case "gu":case "ha":case "he":case "hu":case "is":case "it":case "ku":case "lb":case "ml":case "mn":case "mr":case "nah":case "nb":case "ne":case "nl":case "nn":case "no":case "om":case "or":case "pa":case "pap":case "ps":case "pt":case "so":case "sq":case "sv":case "sw":case "ta":case "te":case "tk":case "ur":case "zu":
                return count == 1 ? 0 : 1;case "am":case "bh":case "fil":case "fr":case "gun":case "hi":case "hy":case "ln":case "mg":case "nso":case "xbr":case "ti":case "wa":
                return count === 0 || count === 1 ? 0 : 1;case "be":case "bs":case "hr":case "ru":case "sr":case "uk":
                return count % 10 == 1 && count % 100 != 11 ? 0 : count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 10 || count % 100 >= 20) ? 1 : 2;case "cs":case "sk":
                return count == 1 ? 0 : count >= 2 && count <= 4 ? 1 : 2;case "ga":
                return count == 1 ? 0 : count == 2 ? 1 : 2;case "lt":
                return count % 10 == 1 && count % 100 != 11 ? 0 : count % 10 >= 2 && (count % 100 < 10 || count % 100 >= 20) ? 1 : 2;case "sl":
                return count % 100 == 1 ? 0 : count % 100 == 2 ? 1 : count % 100 == 3 || count % 100 == 4 ? 2 : 3;case "mk":
                return count % 10 == 1 ? 0 : 1;case "mt":
                return count == 1 ? 0 : count === 0 || count % 100 > 1 && count % 100 < 11 ? 1 : count % 100 > 10 && count % 100 < 20 ? 2 : 3;case "lv":
                return count === 0 ? 0 : count % 10 == 1 && count % 100 != 11 ? 1 : 2;case "pl":
                return count == 1 ? 0 : count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 12 || count % 100 > 14) ? 1 : 2;case "cy":
                return count == 1 ? 0 : count == 2 ? 1 : count == 8 || count == 11 ? 2 : 3;case "ro":
                return count == 1 ? 0 : count === 0 || count % 100 > 0 && count % 100 < 20 ? 1 : 2;case "ar":
                return count === 0 ? 0 : count == 1 ? 1 : count == 2 ? 2 : count % 100 >= 3 && count % 100 <= 10 ? 3 : count % 100 >= 11 && count % 100 <= 99 ? 4 : 5;default:
                return 0;}
    };return Lang;
});(function () {
    Lang = new Lang();Lang.setMessages({ "en.auth": { "failed": "These credentials do not match our records.", "throttle": "Too many login attempts. Please try again in :seconds seconds." }, "en.enums": { "App\\Enums\\RenewalFrequencies": ["Days", "Weeks", "Months", "Years"], "App\\Enums\\RenewalSM": { "renews": "Renew", "0": "To be confirmed", "invoice": "Revenue", "payed": "Paid", "suspend": "Suspend", "to_bill": "To be invoiced", "to_cash": "To cash in", "to_confirm": "To be confirmed", "1": "To be invoiced", "2": "To cash in", "3": "Paid", "4": "Suspended" }, "App\\Enums\\UserType": ["User", "Admin"] }, "en.messages": { "accedi": "Login", "action": "Action", "actions": "Actions", "address": "Address", "admin": "Administrator", "all_customers": "All customers", "all_providers": "All providers", "all_renewal_frequencies": "All renewal frequencies", "all_service_types": "All service types", "all_services": "All services", "all_users": "All users", "amount": "Amount", "april": "April", "are_sure": "Are you sure?", "are_sure_desc": "You wont be able to revert this!", "august": "August", "avarage_revenue": "Average total sales", "avatar": "Avatar", "back": "Back", "calendar": "Calendar", "cancel": "Cancel", "change_avatar": "Change avatar", "change_password": "Change password", "choose_customer": "Please choose a customer", "choose_frequency_renewal": "Please choose a renewal frequency", "choose_provider": "Please choose a provider", "choose_renewal_frequencies_type": "Please choose a type", "choose_renewal_frequencies_value": "Please enter a value", "choose_service_status": "Please assign a state", "choose_service_type": "Please choose a type of service", "confirm": "Confirm", "confirm_delete": "Yes, delete it!", "confirm_desc": "Operation performed successfully.", "confirm_new_password": "Confirm New password", "confirm_password": "Confirm password", "confirm_title": "Great!", "copy": "is licensed under the MIT License by", "currency_format": "Please enter an amount", "current_password": "Current Password", "customer": "Customer", "customer_created_status": "Customer successfully created", "customer_delete_status": "{1}Customer successfully deleted|[2,*]Customers successfully deleted", "customer_info": "Customer info", "customer_reminder_alert_status": "A reminder will be sent to the customer with a list of all its expiring services", "customer_reminder_desc": "Decide on the services you want to renew or cancel", "customer_reminder_name": "Hi, :attribute", "customer_reminder_no_action_desc": "There are no other services to manage", "customer_reminder_no_action_title": "Wonderful", "customer_reminder_success_status": "Reminder sent successfully", "customer_reminder_title": "Hi :attribute, here is the list of your expiring services.", "customer_reminder_warning_status": "Sorry, this customer has no expiring service", "customer_renewal_manager_desc": "Are you sure you want to proceed?", "customer_renewal_manager_title": "All subsequent deadlines will be suspended", "customer_send_manual_reminder": "Send manual reminder to customer", "customer_summary": "Customer summary", "customer_update_status": "Customer successfully updated", "customers": "Customers", "customers_active": "{0} No active customers|[1] active customer|[2,*] active customers", "dashboard": "Dashboard", "deadline": "Deadline", "december": "December", "delete_account": "Delete account", "delete_account_desc": "This will permanently delete all data.", "drop_zone_avatar": "Drop file here or click to upload.", "drop_zone_avatar_desc": "Only image are allowed for upload.", "edit": "Edit", "edit_customer": "Edit customer", "edit_profile": "Edit profile", "edit_provider": "Edit provider", "edit_renewal": "Edit renewal", "edit_renewal_frequency": "Change renewal frequency", "edit_service": "Edit service", "edit_service_type": "Edit service type", "edit_user": "Edit user", "email": "Email", "enter_address": "Please enter your address", "enter_deadline": "Please enter a deadline.", "enter_email": "Please enter your email address", "enter_full_name": "Please enter your full name", "enter_label": "Please enter a label color.", "enter_new_password": "Please enter the new password", "enter_note": "Please enter a note.", "enter_password": "Please enter the current password", "enter_phone": "Please enter your phone number", "enter_service_name": "Please enter a service identifier.", "enter_service_type_name": "Please enter the name of the service type", "enter_url": "Please enter your website URL (ex: https:\/\/www.mydomain.com).", "error_404_desc": "Looks like something went wrong. We're working on it", "error_404_title": "Oops...", "error_authorized": "Nothing left to do here.", "error_desc": "There was a problem.", "error_title": "Error!", "fantastic": "Fantastic!", "february": "February", "frequency_renewal": "Frequency renewal", "full_name": "Full name", "issues_reports": "Issues reports", "january": "January", "july": "July", "june": "June", "label": "Label", "language": "Language", "manage_services": "Manage the services", "march": "March", "may": "May", "monthly_sales_amount": "Monthly sales amount", "name": "Name", "new_customer": "New customer", "new_password": "New Password", "new_provider": "New provider", "new_renewal": "New renewal", "new_renewal_frequency": "New renewal frequency", "new_service": "New service", "new_service_type": "New service type", "new_user": "New user", "new_user_registered": "New registered user", "no_other_services": "There are no other services to manage", "not_account": "Don't have an account yet?", "not_payed": "Not payed", "note": "Note", "november": "November", "obtained_from": "{0}Obtained from :attribute services|[1]Obtained from :attribute service|[2,*]Obtained from :attribute services", "october": "October", "offline": "Offline", "online": "Online", "password": "Password", "password_change_status": "Password updated successfully", "payed": "Payed", "pending_payment": "Pending Payment", "phone": "Phone", "provider": "Provider", "provider_created_status": "Provider successfully created", "provider_delete_status": "{1}Provider successfully deleted|[2,*]Providers successfully deleted", "provider_name": "Please enter the provider name.", "provider_update_status": "Provider successfully updated", "providers": "Providers", "providers_active": "{0} No active providers|[1] active provider|[2,*] active providers", "quick_actions": "Quick actions", "re_enter_new_password": "Please re-type the new password", "re_enter_password": "Please re-type the password", "registries": "Registries", "renewal_create_next_desc": "Change deadline and amount if desired", "renewal_create_next_title": "Do you already want to create the next deadline?", "renewal_created_status": "New deadline created successfully", "renewal_delete_status": "{1}Expiry successfully deleted|[2,*]Deadlines successfully deleted", "renewal_frequencies": "Renewal frequencies", "renewal_frequencies_type": "Type", "renewal_frequencies_value": "Value", "renewal_frequency_created_status": "Renewal frequency successfully created", "renewal_frequency_delete_status": "{1}Renew frequency successfully deleted|[2,*]Renewal frequencies deleted successfully", "renewal_frequency_update_status": "Frequency of renewal updated successfully", "renewal_transition_status": "Successful status change", "renewal_update_status": "Expiry updated successfully", "renewals_history": "Historical Renewals", "revenues": "Revenues", "role": "Role", "sales_impact": "Sales impact", "save": "Save", "selectLang": "Select your language", "select_language": "Please Select the desired language", "september": "September", "service": "Service", "service_created_status": "Service created successfully", "service_delete_status": "{1}Service successfully deleted|[2,*]Services successfully deleted", "service_info": "Service information", "service_name": "Service identifier", "service_status": "Service status", "service_type": "Service type", "service_types": "Service types", "service_types_created_status": "Type of service created successfully", "service_types_delete_status": "{1}Type of service successfully deleted|[2,*]Types of service successfully deleted", "service_types_update_status": "Type of service updated successfully", "service_update_status": "Service updated successfully", "services": "Services", "services_active": "{0} No active services|[1] active service|[2,*] active services", "services_deadline": "Expiring services", "services_expiring": "Services expiring until", "services_status": "Services status", "set_admin": "Please set if this user is administrator.", "site_screenshoot": "Site screenshoot", "status": "Status", "status_payment": "Please set the state of payment.", "summary": "Summary", "support": "Support", "thanks_signature": "Thanks from the staff of", "to_cash_in": "Services to be cashed", "to_solve": "To solve", "topay_services_title": "Hi :attribute, here is the list of your expiring services.", "total_earning": "Total earning", "total_revenue": "Sales figures", "trend": "Trend", "url": "Url", "user": "User", "user_created_status": "User successfully created", "user_delete_status": "{1}User successfully deleted|[2,*]Users successfully deleted", "user_registered_desc": "A new user registered :attribute !", "user_registered_title": "Hi :attribute,", "user_update_status": "User updated successfully", "users": "Users", "users_active": "{0} No active users|[1] active user|[2,*] active users", "website": "Website", "yes_procede": "Yes, of course!" }, "en.pagination": { "next": "Next &raquo;", "previous": "&laquo; Previous" }, "en.passwords": { "password": "Passwords must be at least six characters and match the confirmation.", "reset": "Your password has been reset!", "sent": "We have e-mailed your password reset link!", "token": "This password reset token is invalid.", "user": "We can't find a user with that e-mail address." }, "en.validation": { "accepted": "The :attribute must be accepted.", "active_url": "The :attribute is not a valid URL.", "after": "The :attribute must be a date after :date.", "after_or_equal": "The :attribute must be a date after or equal to :date.", "alpha": "The :attribute may only contain letters.", "alpha_dash": "The :attribute may only contain letters, numbers, dashes and underscores.", "alpha_num": "The :attribute may only contain letters and numbers.", "array": "The :attribute must be an array.", "attributes": [], "before": "The :attribute must be a date before :date.", "before_or_equal": "The :attribute must be a date before or equal to :date.", "between": { "array": "The :attribute must have between :min and :max items.", "file": "The :attribute must be between :min and :max kilobytes.", "numeric": "The :attribute must be between :min and :max.", "string": "The :attribute must be between :min and :max characters." }, "boolean": "The :attribute field must be true or false.", "confirmed": "The :attribute confirmation does not match.", "custom": { "attribute-name": { "rule-name": "custom-message" }, "current_password": { "password_check": "The password is incorrect" }, "renewal_id.*": { "required": "Mandatory choice" } }, "date": "The :attribute is not a valid date.", "date_format": "The :attribute does not match the format :format.", "different": "The :attribute and :other must be different.", "digits": "The :attribute must be :digits digits.", "digits_between": "The :attribute must be between :min and :max digits.", "dimensions": "The :attribute has invalid image dimensions.", "distinct": "The :attribute field has a duplicate value.", "email": "The :attribute must be a valid email address.", "exists": "The selected :attribute is invalid.", "file": "The :attribute must be a file.", "filled": "The :attribute field must have a value.", "gt": { "array": "The :attribute must have more than :value items.", "file": "The :attribute must be greater than :value kilobytes.", "numeric": "The :attribute must be greater than :value.", "string": "The :attribute must be greater than :value characters." }, "gte": { "array": "The :attribute must have :value items or more.", "file": "The :attribute must be greater than or equal :value kilobytes.", "numeric": "The :attribute must be greater than or equal :value.", "string": "The :attribute must be greater than or equal :value characters." }, "image": "The :attribute must be an image.", "in": "The selected :attribute is invalid.", "in_array": "The :attribute field does not exist in :other.", "integer": "The :attribute must be an integer.", "ip": "The :attribute must be a valid IP address.", "ipv4": "The :attribute must be a valid IPv4 address.", "ipv6": "The :attribute must be a valid IPv6 address.", "json": "The :attribute must be a valid JSON string.", "lt": { "array": "The :attribute must have less than :value items.", "file": "The :attribute must be less than :value kilobytes.", "numeric": "The :attribute must be less than :value.", "string": "The :attribute must be less than :value characters." }, "lte": { "array": "The :attribute must not have more than :value items.", "file": "The :attribute must be less than or equal :value kilobytes.", "numeric": "The :attribute must be less than or equal :value.", "string": "The :attribute must be less than or equal :value characters." }, "max": { "array": "The :attribute may not have more than :max items.", "file": "The :attribute may not be greater than :max kilobytes.", "numeric": "The :attribute may not be greater than :max.", "string": "The :attribute may not be greater than :max characters." }, "mimes": "The :attribute must be a file of type: :values.", "mimetypes": "The :attribute must be a file of type: :values.", "min": { "array": "The :attribute must have at least :min items.", "file": "The :attribute must be at least :min kilobytes.", "numeric": "The :attribute must be at least :min.", "string": "The :attribute must be at least :min characters." }, "not_in": "The selected :attribute is invalid.", "not_regex": "The :attribute format is invalid.", "numeric": "The :attribute must be a number.", "present": "The :attribute field must be present.", "regex": "The :attribute format is invalid.", "required": "The :attribute field is required.", "required_if": "The :attribute field is required when :other is :value.", "required_unless": "The :attribute field is required unless :other is in :values.", "required_with": "The :attribute field is required when :values is present.", "required_with_all": "The :attribute field is required when :values is present.", "required_without": "The :attribute field is required when :values is not present.", "required_without_all": "The :attribute field is required when none of :values are present.", "same": "The :attribute and :other must match.", "size": { "array": "The :attribute must contain :size items.", "file": "The :attribute must be :size kilobytes.", "numeric": "The :attribute must be :size.", "string": "The :attribute must be :size characters." }, "string": "The :attribute must be a string.", "timezone": "The :attribute must be a valid zone.", "unique": "The :attribute has already been taken.", "unique_date_custom": ":attribute has already been taken.", "uploaded": "The :attribute failed to upload.", "url": "The :attribute format is invalid." }, "es.auth": { "failed": "Estas credenciales no coinciden con nuestros registros.", "throttle": "Demasiados intentos de acceso. Por favor intente nuevamente en :seconds segundos." }, "es.enums": { "App\\Enums\\RenewalFrequencies": ["D\xEDas", "Semanas", "Meses", "A\xF1os"], "App\\Enums\\RenewalSM": { "renews": "Renovar", "0": "Para ser confirmado", "invoice": "Proyecto de ley", "payed": "Pagado", "suspend": "Suspender", "to_bill": "A facturar", "to_cash": "Para ser redimido", "to_confirm": "Para ser confirmado", "1": "A facturar", "2": "Para ser redimido", "3": "Pagado", "4": "Suspendido" }, "App\\Enums\\UserType": ["Usuario", "Administrador"] }, "es.messages": { "accedi": "Iniciar sesi\xF3n", "action": "Acci\xF3n", "actions": "Comportamiento", "address": "Direcci\xF3n", "admin": "Administrador", "all_customers": "Todos los clientes", "all_providers": "Todos los proveedores", "all_renewal_frequencies": "Todas las frecuencias de renovaci\xF3n", "all_service_types": "Todos los tipos de servicios", "all_services": "Todos los servicios", "all_users": "Todos los usuarios", "amount": "Cantidad", "april": "Abril", "are_sure": "Est\xE1s seguro?", "are_sure_desc": "No podr\xE1s revertir esto!", "august": "Agosto", "avarage_revenue": "Ventas totales promedio", "avatar": "Avatar", "back": "Volver atr\xE1s", "calendar": "Calendario", "cancel": "Cancelar", "change_avatar": "Cambiar avatar", "change_password": "Cambia la contrase\xF1a", "choose_customer": "Por favor elija un cliente", "choose_frequency_renewal": "Por favor, elija una frecuencia de renovaci\xF3n", "choose_provider": "Por favor elija un proveedor", "choose_renewal_frequencies_type": "Por favor elige un tipo", "choose_renewal_frequencies_value": "Por favor ingrese un valor", "choose_service_status": "Por favor asigne un estado", "choose_service_type": "Por favor elija un tipo de servicio", "confirm": "Confirmaci\xF3n", "confirm_delete": "S\xED, eliminarlo!", "confirm_desc": "Operaci\xF3n realizada con \xE9xito.", "confirm_new_password": "Confirmar nueva contrase\xF1a", "confirm_password": "Confirmar contrase\xF1a", "confirm_title": "Estupendo!", "copy": "est\xE1 licenciado bajo la Licencia MIT por", "currency_format": "Por favor ingrese una cantidad", "current_password": "Contrase\xF1a actual", "customer": "Cliente", "customer_created_status": "Cliente creado exitosamente", "customer_delete_status": "{1}Cliente eliminado exitosamente|[2,*]Clientes eliminados exitosamente", "customer_info": "Informaci\xF3n del cliente", "customer_reminder_alert_status": "Se enviar\xE1 un recordatorio al cliente con una lista de todos los servicios que expiran", "customer_reminder_desc": "Decide los servicios que deseas renovar o cancelar", "customer_reminder_name": "Hola, :attribute", "customer_reminder_no_action_desc": "No hay otros servicios para gestionar.", "customer_reminder_no_action_title": "Fant\xE1stico", "customer_reminder_success_status": "Recordatorio enviado correctamente", "customer_reminder_title": "Hola :attribute, aqu\xED est\xE1 la lista de tus servicios que expiran.", "customer_reminder_warning_status": "Lo sentimos, este cliente no tiene servicio que expira.", "customer_renewal_manager_desc": "Est\xE1s seguro de que quieres proceder?", "customer_renewal_manager_title": "Todos los plazos posteriores ser\xE1n suspendidos", "customer_send_manual_reminder": "Enviar recordatorio manual al cliente", "customer_summary": "Resumen del cliente", "customer_update_status": "Cliente actualizado exitosamente", "customers": "Clientes", "customers_active": "{0} Sin clientes activos|[1] cliente activo|[2,*] clientes activos", "dashboard": "Tablero", "deadline": "Fecha tope", "december": "Diciembre", "delete_account": "Borrar cuenta", "delete_account_desc": "Esto eliminar\xE1 permanentemente todos los datos.", "drop_zone_avatar": "Suelta el archivo aqu\xED o haz clic para cargarlo.", "drop_zone_avatar_desc": "Solo la imagen est\xE1 permitida para subir.", "edit": "Editar", "edit_customer": "Editar cliente", "edit_profile": "Editar perfil", "edit_provider": "Editar proveedor", "edit_renewal": "Cambiar plazo", "edit_renewal_frequency": "Cambiar frecuencia de renovaci\xF3n", "edit_service": "Editar servicio", "edit_service_type": "Cambiar tipo de servicio", "edit_user": "Editar usuario", "email": "Email", "enter_address": "Por favor ingrese su direcci\xF3n", "enter_deadline": "Por favor ingrese una fecha l\xEDmite.", "enter_email": "Por favor, introduzca su direcci\xF3n de correo electr\xF3nico", "enter_full_name": "Por favor ingresa tu nombre completo", "enter_label": "Por favor ingrese un color de etiqueta.", "enter_new_password": "Por favor ingrese la nueva contrase\xF1a", "enter_note": "Por favor ingrese una nota.", "enter_password": "Por favor ingrese la contrase\xF1a actual", "enter_phone": "Por favor introduzca su n\xFAmero de tel\xE9fono", "enter_service_name": "Por favor, introduzca un identificador de servicio.", "enter_service_type_name": "Por favor ingrese el nombre del tipo de servicio", "enter_url": "Por favor ingrese la URL de su sitio web (ej: https:\/\/www.midominio.com).", "error_404_desc": "Parece que algo sali\xF3 mal. Estamos trabajando en ello", "error_404_title": "Oops...", "error_authorized": "No queda nada por hacer aqu\xED.", "error_desc": "There was a problem.", "error_title": "Error!", "fantastic": "Fant\xE1stico!", "february": "Febrero", "frequency_renewal": "Renovaci\xF3n de frecuencia", "full_name": "Nombre completo", "issues_reports": "Informes de problemas", "january": "Enero", "july": "Julio", "june": "Junio", "label": "Etiqueta", "language": "Idioma", "manage_services": "Gestionar servicios", "march": "Marzo", "may": "Mayo", "monthly_sales_amount": "Cantidad de ventas mensuales", "name": "Nombre", "new_customer": "Nuevo cliente", "new_password": "Nueva contrase\xF1a", "new_provider": "Nuevo proveedor", "new_renewal": "Nueva fecha l\xEDmite", "new_renewal_frequency": "Nueva frecuencia de renovaci\xF3n", "new_service": "Nuevo servicio", "new_service_type": "Nuevo tipo de servicio", "new_user": "Nuevo usuario", "new_user_registered": "Nuevo usuario registrado", "no_other_services": "No hay otros Servicios para administrar", "not_account": "Todav\xEDa no tienes una cuenta?", "not_payed": "No pagado", "note": "Nota", "november": "Noviembre", "obtained_from": "{0}Obtenido de :attribute servicios|[1]Obtenido de :attribute servicio|[2,*]Obtenido de :attribute servicios", "october": "Octubre", "offline": "Desconectado", "online": "En l\xEDnea", "password": "Contrase\xF1a", "password_change_status": "Contrase\xF1a actualizada correctamente", "payed": "Pagado", "pending_payment": "Pago pendiente", "phone": "Tel\xE9fono", "provider": "Proveedor", "provider_created_status": "Proveedor creado con \xE9xito", "provider_delete_status": "{1}Proveedor eliminado exitosamente|[2,*]Proveedores eliminados exitosamente", "provider_name": "Por favor ingrese el nombre del proveedor.", "provider_update_status": "Proveedor actualizado con \xE9xito", "providers": "Proveedores", "providers_active": "{0} Sin proveedores activos|[1] proveedor activo|[2,*] proveedores activos", "quick_actions": "Acciones r\xE1pidas", "re_enter_new_password": "Por favor, vuelva a escribir la nueva contrase\xF1a", "re_enter_password": "Por favor, vuelva a escribir la contrase\xF1a", "registries": "Registros", "renewal_create_next_desc": "Cambia el plazo y la cantidad si lo deseas", "renewal_create_next_title": "Ya quieres crear el pr\xF3ximo plazo?", "renewal_created_status": "Nuevo plazo creado con \xE9xito.", "renewal_delete_status": "{1}Caducidad eliminada correctamente|[2,*]Plazos eliminados con \xE9xito", "renewal_frequencies": "Frecuencias de renovaci\xF3n", "renewal_frequencies_type": "Tipo", "renewal_frequencies_value": "Valor", "renewal_frequency_created_status": "Frecuencia de renovaci\xF3n creada exitosamente", "renewal_frequency_delete_status": "{1}Renovar frecuencia eliminada con \xE9xito|[2,*]Frecuencias de renovaci\xF3n eliminadas con \xE9xito", "renewal_frequency_update_status": "Frecuencia de renovaci\xF3n actualizada con \xE9xito.", "renewal_transition_status": "Cambio de estado exitoso", "renewal_update_status": "Caducidad actualizada con \xE9xito.", "renewals_history": "Renovaciones hist\xF3ricas", "revenues": "Ingresos", "role": "Papel", "sales_impact": "Impacto en las ventas", "save": "Salvar", "selectLang": "Elige tu idioma", "select_language": "Por favor, seleccione el idioma deseado", "september": "Septiembre", "service": "Servicio", "service_created_status": "Servicio creado exitosamente", "service_delete_status": "{1}Servicio eliminado exitosamente|[2,*]Servicios eliminados con \xE9xito", "service_info": "Informacion de servicio", "service_name": "Identificativo del servizio", "service_status": "Estado del servicio", "service_type": "Tipo de servicio", "service_types": "Tipos de servicio", "service_types_created_status": "Tipo de servicio creado exitosamente", "service_types_delete_status": "{1}Tipo de servicio eliminado exitosamente|[2,*]Tipos de servicio eliminados con \xE9xito", "service_types_update_status": "Tipo de servicio actualizado exitosamente", "service_update_status": "Servicio actualizado exitosamente", "services": "Servicios", "services_active": "{0} Sin servicios activos|[1] servicio activo|[2,*] servicios activos", "services_deadline": "servicios caducados", "services_expiring": "Servicios que expiran hasta", "services_status": "El estado de los servicios", "set_admin": "Establezca si este usuario es administrador.", "site_screenshoot": "Captura de pantalla del sitio", "status": "Estado", "status_payment": "Por favor, configure el estado de pago.", "summary": "Resumen", "support": "Apoyo", "thanks_signature": "Gracias del personal de", "to_cash_in": "Servicios a cobrar", "to_solve": "Ser resuelto", "topay_services_title": "Hola :attribute, aqu\xED est\xE1 la lista de tus servicios que expiran.", "total_earning": "Ganancia total", "total_revenue": "Cifras de ventas", "trend": "Tendencia", "url": "Url", "user": "Usuario", "user_created_status": "Usuario creado con \xE9xito", "user_delete_status": "{1}Usuario eliminado exitosamente|[2,*]Usuarios eliminados exitosamente", "user_registered_desc": "Un nuevo usuario registrado :attribute !", "user_registered_title": "Hola :attribute,", "user_update_status": "Usuario actualizado exitosamente", "users": "Usuarios", "users_active": "{0} No usuarios activos|[1] usuario activo|[2,*] usuarios activos", "website": "Sitio web", "yes_procede": "S\xED, por supuesto!" }, "es.pagination": { "next": "Siguiente &raquo;", "previous": "&laquo; Anterior" }, "es.passwords": { "password": "Las contrase\xF1as deben coincidir y contener al menos 6 caracteres", "reset": "\xA1Tu contrase\xF1a ha sido restablecida!", "sent": "\xA1Te hemos enviado por correo el enlace para restablecer tu contrase\xF1a!", "token": "El token de recuperaci\xF3n de contrase\xF1a es inv\xE1lido.", "user": "No podemos encontrar ning\xFAn usuario con ese correo electr\xF3nico." }, "es.strings": { "A fresh verification link has been sent to your email address.": "Se ha enviado un nuevo enlace de verificaci\xF3n a su direcci\xF3n de correo electr\xF3nico.", "All rights reserved.": "Todos los derechos reservados.", "Before proceeding, please check your email for a verification link.": "Antes de continuar, compruebe su correo electr\xF3nico para ver un enlace de verificaci\xF3n.", "Confirm Password": "Confirmar contrase\xF1a", "E-Mail Address": "Direcci\xF3n de correo electr\xF3nico", "Error": "Error", "Forbidden": "Prohibido", "Forgot Your Password?": "Olvidaste tu contrase\xF1a?", "Go Home": "Ir a la casa", "Hello!": "Hola!", "If you did not create an account, no further action is required.": "Si no cre\xF3 una cuenta, no se requiere ninguna acci\xF3n adicional.", "If you did not receive the email": "Si no ha recibido el correo electr\xF3nico.", "If you did not request a password reset, no further action is required.": "Si no solicit\xF3 un restablecimiento de contrase\xF1a, no es necesario realizar ninguna otra acci\xF3n.", "If you\u2019re having trouble clicking the \":actionText\" button, copy and paste the URL below\ninto your web browser: [:actionURL](:actionURL)": "Si tiene problemas para hacer clic en el \":actionText\" bot\xF3n, copie y pegue la URL a continuaci\xF3n\nsu navegador web: [:actionURL](:actionURL)", "Login": "Iniciar sesi\xF3n", "Logout": "Cerrar sesi\xF3n", "Name": "Nombre", "Oh no": "Oh no", "Page Expired": "P\xE1gina caducada", "Page Not Found": "P\xE1gina no encontrad", "Password": "Contrase\xF1a", "Please click the button below to verify your email address.": "Haga clic en el bot\xF3n de abajo para verificar su direcci\xF3n de correo electr\xF3nico.", "Regards": "Saludos", "Register": "Registro", "Remember Me": "Recu\xE9rdame", "Reset Password": "Restablecer la contrase\xF1a", "Reset Password Notification": "Restablecer notificaci\xF3n de contrase\xF1a", "Send Password Reset Link": "Enviar contrase\xF1a Restablecer enlace", "Service Unavailable": "Servicio no disponible", "Sorry, the page you are looking for could not be found.": "Lo sentimos, no se pudo encontrar la p\xE1gina que est\xE1s buscando.", "Sorry, we are doing some maintenance. Please check back soon.": "Lo sentimos, estamos haciendo un poco de mantenimiento. Por favor, revise luego.", "Sorry, you are forbidden from accessing this page.": "Lo sentimos, est\xE1 prohibido acceder a esta p\xE1gina.", "Sorry, you are making too many requests to our servers.": "Lo sentimos, est\xE1s haciendo demasiadas solicitudes a nuestros servidores.", "Sorry, you are not authorized to access this page.": "Lo sentimos, no est\xE1s autorizado para acceder a esta p\xE1gina.", "Sorry, your session has expired. Please refresh and try again.": "Lo sentimos, tu sesi\xF3n ha expirado. Por favor, actualice y pruebe de nuevo.", "Toggle navigation": "Navegaci\xF3n de palanca", "Too Many Requests": "Demasiadas solicitudes", "Unauthorized": "No autorizado", "Verify Email Address": "Confirme su direcci\xF3n de correo electr\xF3nico", "Verify Your Email Address": "Verifique su direcci\xF3n de correo electr\xF3nico", "Whoops!": "Maldita sea!", "Whoops, something went wrong on our servers.": "Maldita sea, algo sali\xF3 mal en nuestros servidores.", "You are receiving this email because we received a password reset request for your account.": "Est\xE1 recibiendo este correo electr\xF3nico porque recibimos una solicitud de restablecimiento de contrase\xF1a para su cuenta.", "click here to request another": "haga clic aqu\xED para solicitar otro", "hi": "hola" }, "es.validation": { "accepted": ":attribute debe ser aceptado.", "active_url": ":attribute no es una URL v\xE1lida.", "after": ":attribute debe ser una fecha posterior a :date.", "after_or_equal": ":attribute debe ser una fecha posterior o igual a :date.", "alpha": ":attribute s\xF3lo debe contener letras.", "alpha_dash": ":attribute s\xF3lo debe contener letras, n\xFAmeros y guiones.", "alpha_num": ":attribute s\xF3lo debe contener letras y n\xFAmeros.", "array": ":attribute debe ser un conjunto.", "attributes": { "address": "direcci\xF3n", "age": "edad", "body": "contenido", "city": "ciudad", "content": "contenido", "country": "pa\xEDs", "date": "fecha", "day": "d\xEDa", "description": "descripci\xF3n", "email": "correo electr\xF3nico", "excerpt": "extracto", "first_name": "nombre", "gender": "g\xE9nero", "hour": "hora", "last_name": "apellido", "message": "mensaje", "minute": "minuto", "mobile": "m\xF3vil", "month": "mes", "name": "nombre", "password": "contrase\xF1a", "password_confirmation": "confirmaci\xF3n de la contrase\xF1a", "phone": "tel\xE9fono", "second": "segundo", "sex": "sexo", "subject": "asunto", "time": "hora", "title": "t\xEDtulo", "username": "usuario", "year": "a\xF1o" }, "before": ":attribute debe ser una fecha anterior a :date.", "before_or_equal": ":attribute debe ser una fecha anterior o igual a :date.", "between": { "array": ":attribute tiene que tener entre :min - :max \xEDtems.", "file": ":attribute debe pesar entre :min - :max kilobytes.", "numeric": ":attribute tiene que estar entre :min - :max.", "string": ":attribute tiene que tener entre :min - :max caracteres." }, "boolean": "El campo :attribute debe tener un valor verdadero o falso.", "confirmed": "La confirmaci\xF3n de :attribute no coincide.", "custom": { "current_password": { "password_check": "La contrase\xF1a es incorrecta" }, "email": { "unique": "El :attribute ya ha sido registrado." }, "password": { "min": "La :attribute debe contener m\xE1s de :min caracteres" }, "renewal_id.*": { "required": "Elecci\xF3n obligatoria" } }, "date": ":attribute no es una fecha v\xE1lida.", "date_format": ":attribute no corresponde al formato :format.", "different": ":attribute y :other deben ser diferentes.", "digits": ":attribute debe tener :digits d\xEDgitos.", "digits_between": ":attribute debe tener entre :min y :max d\xEDgitos.", "dimensions": "Las dimensiones de la imagen :attribute no son v\xE1lidas.", "distinct": "El campo :attribute contiene un valor duplicado.", "email": ":attribute no es un correo v\xE1lido", "exists": ":attribute es inv\xE1lido.", "file": "El campo :attribute debe ser un archivo.", "filled": "El campo :attribute es obligatorio.", "gt": { "array": "El campo :attribute debe tener m\xE1s de :value elementos.", "file": "El campo :attribute debe tener m\xE1s de :value kilobytes.", "numeric": "El campo :attribute debe ser mayor que :value.", "string": "El campo :attribute debe tener m\xE1s de :value caracteres." }, "gte": { "array": "El campo :attribute debe tener como m\xEDnimo :value elementos.", "file": "El campo :attribute debe tener como m\xEDnimo :value kilobytes.", "numeric": "El campo :attribute debe ser como m\xEDnimo :value.", "string": "El campo :attribute debe tener como m\xEDnimo :value caracteres." }, "image": ":attribute debe ser una imagen.", "in": ":attribute es inv\xE1lido.", "in_array": "El campo :attribute no existe en :other.", "integer": ":attribute debe ser un n\xFAmero entero.", "ip": ":attribute debe ser una direcci\xF3n IP v\xE1lida.", "ipv4": ":attribute debe ser un direcci\xF3n IPv4 v\xE1lida", "ipv6": ":attribute debe ser un direcci\xF3n IPv6 v\xE1lida.", "json": "El campo :attribute debe tener una cadena JSON v\xE1lida.", "lt": { "array": "El campo :attribute debe tener menos de :value elementos.", "file": "El campo :attribute debe tener menos de :value kilobytes.", "numeric": "El campo :attribute debe ser menor que :value.", "string": "El campo :attribute debe tener menos de :value caracteres." }, "lte": { "array": "El campo :attribute debe tener como m\xE1ximo :value elementos.", "file": "El campo :attribute debe tener como m\xE1ximo :value kilobytes.", "numeric": "El campo :attribute debe ser como m\xE1ximo :value.", "string": "El campo :attribute debe tener como m\xE1ximo :value caracteres." }, "max": { "array": ":attribute no debe tener m\xE1s de :max elementos.", "file": ":attribute no debe ser mayor que :max kilobytes.", "numeric": ":attribute no debe ser mayor a :max.", "string": ":attribute no debe ser mayor que :max caracteres." }, "mimes": ":attribute debe ser un archivo con formato: :values.", "mimetypes": ":attribute debe ser un archivo con formato: :values.", "min": { "array": ":attribute debe tener al menos :min elementos.", "file": "El tama\xF1o de :attribute debe ser de al menos :min kilobytes.", "numeric": "El tama\xF1o de :attribute debe ser de al menos :min.", "string": ":attribute debe contener al menos :min caracteres." }, "not_in": ":attribute es inv\xE1lido.", "not_regex": "El formato del campo :attribute no es v\xE1lido.", "numeric": ":attribute debe ser num\xE9rico.", "present": "El campo :attribute debe estar presente.", "regex": "El formato de :attribute es inv\xE1lido.", "required": "El campo :attribute es obligatorio.", "required_if": "El campo :attribute es obligatorio cuando :other es :value.", "required_unless": "El campo :attribute es obligatorio a menos que :other est\xE9 en :values.", "required_with": "El campo :attribute es obligatorio cuando :values est\xE1 presente.", "required_with_all": "El campo :attribute es obligatorio cuando :values est\xE1 presente.", "required_without": "El campo :attribute es obligatorio cuando :values no est\xE1 presente.", "required_without_all": "El campo :attribute es obligatorio cuando ninguno de :values est\xE9n presentes.", "same": ":attribute y :other deben coincidir.", "size": { "array": ":attribute debe contener :size elementos.", "file": "El tama\xF1o de :attribute debe ser :size kilobytes.", "numeric": "El tama\xF1o de :attribute debe ser :size.", "string": ":attribute debe contener :size caracteres." }, "string": "El campo :attribute debe ser una cadena de caracteres.", "timezone": "El :attribute debe ser una zona v\xE1lida.", "unique": ":attribute ya ha sido registrado.", "unique_date_custom": ":attribute ya ha sido registrado.", "uploaded": "Subir :attribute ha fallado.", "url": "El formato :attribute es inv\xE1lido." }, "it.auth": { "failed": "Credenziali non corrispondenti ai dati registrati.", "throttle": "Troppi tentativi di accesso. Riprova tra :seconds secondi." }, "it.enums": { "App\\Enums\\RenewalFrequencies": ["Giorni", "Settimane", "Mesi", "Anni"], "App\\Enums\\RenewalSM": { "renews": "Rinnova", "0": "Da confermare", "invoice": "Fatturato", "payed": "Pagato", "suspend": "Sospendi", "to_bill": "Da fatturare", "to_cash": "Da incassare", "to_confirm": "Da confermare", "1": "Da fatturare", "2": "Da incassare", "3": "Pagato", "4": "Sospeso" }, "App\\Enums\\UserType": ["Utente", "Amministratore"] }, "it.messages": { "accedi": "Accedi", "action": "Azione", "actions": "Azioni", "address": "Indirizzo", "admin": "Amministratore", "all_customers": "Tutti i clienti", "all_providers": "Tutti i fornitori", "all_renewal_frequencies": "Tutte le frequenze di rinnovo", "all_service_types": "Tutti i tipi di servizio", "all_services": "Tutti i servizi", "all_users": "Tutti gli utenti", "amount": "Totale", "april": "Aprile", "are_sure": "Sei sicuro?", "are_sure_desc": "Non sarai in grado di ripristinare questo!", "august": "Agosto", "avarage_revenue": "Media delle vendite totali", "avatar": "Avatar", "back": "Torna indietro", "calendar": "Calendario", "cancel": "Cancella", "change_avatar": "Cambia avatar", "change_password": "Cambia password", "choose_customer": "Si prega di scegliere un cliente", "choose_frequency_renewal": "Per favore scegli una frequenza di rinnovo", "choose_provider": "Si prega di scegliere un fornitore", "choose_renewal_frequencies_type": "Si prega di scegliere un tipo", "choose_renewal_frequencies_value": "Si prega di inserire un valore", "choose_service_status": "Per favore assegna uno stato", "choose_service_type": "Si prega di scegliere un tipo di servizio", "confirm": "Conferma", "confirm_delete": "S\xEC, cancellalo!", "confirm_desc": "Operazione eseguita con successo.", "confirm_new_password": "Conferma la nuova password", "confirm_password": "Conferma password", "confirm_title": "Grande!", "copy": "\xE8 concesso in licenza con la licenza MIT da", "currency_format": "Si prega di inserire un importo", "current_password": "Password attuale", "customer": "Cliente", "customer_created_status": "Cliente creato con successo", "customer_delete_status": "{1}Cliente eliminato con successo|[2,*]Clienti eliminati con successo", "customer_info": "Informazioni sul cliente", "customer_reminder_alert_status": "Verr\xE0 inviato un promemoria al cliente con l'elenco di tutti i suoi servizi in scadenza", "customer_reminder_desc": "Decidi i servizi che vuoi rinnovare o disdire", "customer_reminder_name": "Ciao, :attribute", "customer_reminder_no_action_desc": "Non ci sono altri servizi da gestire", "customer_reminder_no_action_title": "Fantastico", "customer_reminder_success_status": "Promemoria inviato con successo", "customer_reminder_title": "Ciao :attribute, ecco la lista dei tuoi servizi in scadenza.", "customer_reminder_warning_status": "Spiacenti, questo cliente non ha nessun servizio in scadenza", "customer_renewal_manager_desc": "Sicuro di voler procedere?", "customer_renewal_manager_title": "Verranno sospese tutte le scadenze successive", "customer_send_manual_reminder": "Invia promemoria manuale al cliente", "customer_summary": "Riepilogo del cliente", "customer_update_status": "Cliente aggiornato con successo", "customers": "Clienti", "customers_active": "{0} Nessun cliente attivo|[1] cliente attivo|[2,*] clienti attivi", "dashboard": "Dashboard", "deadline": "Scadenza", "december": "Dicembre", "delete_account": "Elimina account", "delete_account_desc": "Questo canceller\xE0 definitivamente tutti i dati.", "drop_zone_avatar": "Trascina il file o clicca per caricare.", "drop_zone_avatar_desc": "Solo immagini sono permesse.", "edit": "Modifica", "edit_customer": "Modifica cliente", "edit_profile": "Modifica profilo", "edit_provider": "Modifica fornitore", "edit_renewal": "Modifica scadenza", "edit_renewal_frequency": "Modifica frequenza di rinnovo", "edit_service": "Modifica servizio", "edit_service_type": "Modifica tipo di servizio", "edit_user": "Modifica utente", "email": "Email", "enter_address": "Per favore inserisci il tuo indirizzo", "enter_deadline": "Si prega di inserire una scadenza.", "enter_email": "Inserisci il tuo indirizzo email", "enter_full_name": "Inserisci il tuo nome e cognome", "enter_label": "Si prega di inserire un colore dell'etichetta.", "enter_new_password": "Si prega di inserire la nuova password", "enter_note": "Si prega di inserire una nota.", "enter_password": "Si prega di inserire la password corrente", "enter_phone": "Per favore inserire il numero di telefono", "enter_service_name": "Si prega di inserire un identificativo del servizio.", "enter_service_type_name": "Si prega di inserire il nome del tipo servizio", "enter_url": "Inserisci l'URL del tuo sito web (es: https:\/\/www.miodominio.com).", "error_404_desc": "Sembra che qualcosa sia andato storto. Ci stiamo lavorando", "error_404_title": "Oops...", "error_authorized": "Niente da fare qui.", "error_desc": "There was a problem.", "error_title": "Error!", "fantastic": "Fantastico!", "february": "Febbraio", "frequency_renewal": "Frequenza di rinnovo", "full_name": "Nome e cognome", "issues_reports": "Segnala problemi", "january": "Gennaio", "july": "Luglio", "june": "Giugno", "label": "Etichetta", "language": "Lingua", "manage_services": "Gestisci i servizi", "march": "Marzo", "may": "Maggio", "monthly_sales_amount": "Importo mensile delle vendite", "name": "Nome", "new_customer": "Nuovo cliente", "new_password": "Nuova password", "new_provider": "Nuovo fornitore", "new_renewal": "Nuova scadenza", "new_renewal_frequency": "Nuova frequenza di rinnovo", "new_service": "Nuovo servizio", "new_service_type": "Nuovo tipo di servizio", "new_user": "Nuovo utente", "new_user_registered": "Nuovo utente registrato", "no_other_services": "Non ci sono altri servizi da gestire", "not_account": "Non hai ancora un account?", "not_payed": "Non pagato", "note": "Note", "november": "Novembre", "obtained_from": "{0}Ottenuto da :attribute servizi|[1]Ottenuto da :attribute servizio|[2,*]Ottenuto da :attribute servizi", "october": "Ottobre", "offline": "Offline", "online": "Online", "password": "Password", "password_change_status": "Password aggiornata con successo", "payed": "Pagato", "pending_payment": "In attesa di Pagamento", "phone": "Telefono", "provider": "Fornitore", "provider_created_status": "Fornitore creato con successo", "provider_delete_status": "{1}Fornitore eliminato con successo|[2,*]Fornitori eliminati con successo", "provider_name": "Si prega di inserire il nome del fornitore.", "provider_update_status": "Fornitore aggiornato con successo", "providers": "Fornitori", "providers_active": "{0} Nessun fornitore attivo|[1] fornitore attivo|[2,*] fornitori attivi", "quick_actions": "Azioni rapide", "re_enter_new_password": "Si prega di ri-digitare la nuova password", "re_enter_password": "Si prega di ri-digitare la password", "registries": "Anagrafiche", "renewal_create_next_desc": "Modifica scadenza e importo se lo desideri", "renewal_create_next_title": "Vuoi gi\xE0 creare la prossima scadenza?", "renewal_created_status": "Nuova scadenza creata con successo", "renewal_delete_status": "{1}Scadenza eliminata con successo|[2,*]Scadenza eliminate con successo", "renewal_frequencies": "Frequenze di rinnovo", "renewal_frequencies_type": "Tipo", "renewal_frequencies_value": "Valore", "renewal_frequency_created_status": "Frequenza di rinnovo creata con successo", "renewal_frequency_delete_status": "{1}Frequenza di rinnovo eliminata con successo|[2,*]Frequenze di rinnovo eliminate con successo", "renewal_frequency_update_status": "Frequenza di rinnovo aggiornata con successo", "renewal_transition_status": "Cambio di stato effettuato con successo", "renewal_update_status": "Scadenza aggiornata con successo", "renewals_history": "Storico rinnovi", "revenues": "Ricavi", "role": "Ruolo", "sales_impact": "Impatto sul fatturato", "save": "Salva", "selectLang": "Seleziona lingua", "select_language": "Seleziona la lingua desiderata", "september": "Settembre", "service": "Servizio", "service_created_status": "Servizio creato con successo", "service_delete_status": "{1}Servizio eliminato con successo|[2,*]Servizi eliminati con successo", "service_info": "Informazioni sul servizio", "service_name": "Identificativo del servizio", "service_status": "Stato del servizio", "service_type": "Tipo di servizio", "service_types": "Tipi di servizio", "service_types_created_status": "Tipo di servizio creato con successo", "service_types_delete_status": "{1}Tipo di servizio eliminato con successo|[2,*]Tipi di servizio eliminati con successo", "service_types_update_status": "Tipo di servizio aggiornato con successo", "service_update_status": "Servizio aggiornato con successo", "services": "Servizi", "services_active": "{0} Nessun servizio attivo|[1] servizio attivo|[2,*] servizi attivi", "services_deadline": "Servizi in scadenza", "services_expiring": "Servizi in scadenza fino a", "services_status": "Stato dei servizi", "set_admin": "Si prega di impostare se questo utente \xE8 amministratore.", "site_screenshoot": "Screenshoot del sito", "status": "Stato", "status_payment": "Si prega di impostare lo stato di pagamento.", "summary": "Riepilogo", "support": "Supporto", "thanks_signature": "Grazie dallo staff di", "to_cash_in": "Servizi da incassare", "to_solve": "Da risolvere", "topay_services_title": "Ciao :attribute, ecco la lista dei tuoi servizi in scadenza.", "total_earning": "Guadagno totale", "total_revenue": "Cifre di vendita", "trend": "Trend", "url": "Url", "user": "Utente", "user_created_status": "Utente creato con successo", "user_delete_status": "{1}Utente eliminato con successo|[2,*]Utenti eliminati con successo", "user_registered_desc": "Un nuovo utente si \xE8 registrato :attribute !", "user_registered_title": "Ciao :attribute,", "user_update_status": "Utente aggiornato con successo", "users": "Utenti", "users_active": "{0} Nessun utente attivo|[1] utente attivo|[2,*] utenti attivi", "website": "Sito web", "yes_procede": "S\xEC, procedi!" }, "it.pagination": { "next": "Successivo &raquo;", "previous": "&laquo; Precedente" }, "it.passwords": { "password": "Le password devono essere di almeno 6 caratteri e devono coincidere.", "reset": "La password \xE8 stata reimpostata!", "sent": "Promemoria della password inviato!", "token": "Questo token per la reimpostazione della password non \xE8 valido.", "user": "Non esiste un utente associato a questo indirizzo e-mail." }, "it.strings": { "A fresh verification link has been sent to your email address.": "Un nuovo link di verifica \xE8 stato inviato al tuo indirizzo email.", "All rights reserved.": "Tutti i diritti riservati.", "Before proceeding, please check your email for a verification link.": "Prima di procedere, controlla la tua email per il link di verifica.", "Confirm Password": "Conferma Password", "E-Mail Address": "Indirizzo email", "Error": "Errore", "Forbidden": "Proibito", "Forgot Your Password?": "Hai dimenticato la password?", "Go Home": "Vai alla Home", "Hello!": "Ciao!", "If you did not create an account, no further action is required.": "Se non hai creato un account, non sono necessarie ulteriori azioni.", "If you did not receive the email": "Se non hai ricevuto l'email", "If you did not request a password reset, no further action is required.": "Se non hai richiesto la reimpostazione della password, non sono necessarie ulteriori azioni.", "If you\u2019re having trouble clicking the \":actionText\" button, copy and paste the URL below\ninto your web browser: [:actionURL](:actionURL)": "Se riscontri problemi nel fare clic sul pulsante \":actionText\", copia e incolla l'URL qui sotto\ndel tuo browser web: [:actionURL](:actionURL)", "Login": "Login", "Logout": "Logout", "Name": "Nome", "Oh no": "Oh no", "Page Expired": "Pagina scaduta", "Page Not Found": "Pagina non trovata", "Password": "Password", "Please click the button below to verify your email address.": "Fai clic sul pulsante qui sotto per verificare il tuo indirizzo email.", "Regards": "Saluti", "Register": "Registrati", "Remember Me": "Ricordati di me", "Reset Password": "Resetta la password", "Reset Password Notification": "Ripristina notifica passwordn", "Send Password Reset Link": "Invia il link per reimpostare la password", "Service Unavailable": "Servizio non disponibile", "Sorry, the page you are looking for could not be found.": "Siamo spiacenti, la pagina che stai cercando non \xE8 stata trovata.", "Sorry, we are doing some maintenance. Please check back soon.": "Scusa, stiamo facendo un po 'di manutenzione. Si prega di ricontrollare presto.", "Sorry, you are forbidden from accessing this page.": "Siamo spiacenti, non puoi avere accesso a questa pagina.", "Sorry, you are making too many requests to our servers.": "Scusa, stai facendo troppe richieste ai nostri server.", "Sorry, you are not authorized to access this page.": "Siamo spiacenti, non sei autorizzato ad accedere a questa pagina.", "Sorry, your session has expired. Please refresh and try again.": "Siamo spiacenti, la tua sessione \xE8 scaduta. Si prega di aggiornare e riprovare.", "Toggle navigation": "Attiva\/disattiva la navigazione", "Too Many Requests": "Troppe richieste", "Unauthorized": "Non autorizzato", "Verify Email Address": "Verifica indirizzo e-mail", "Verify Your Email Address": "Verifica il tuo indirizzo email", "Whoops!": "Ops!", "Whoops, something went wrong on our servers.": "Ops, qualcosa \xE8 andato storto sui nostri server.", "You are receiving this email because we received a password reset request for your account.": "Hai ricevuto questa email perch\xE9 abbiamo ricevuto una richiesta di reimpostazione della password per il tuo account.", "click here to request another": "clicca qui per richiederne un altro", "hi": "ciao" }, "it.validation": { "accepted": ":attribute deve essere accettato.", "active_url": ":attribute non \xE8 un URL valido.", "after": ":attribute deve essere una data successiva al :date.", "after_or_equal": ":attribute deve essere una data successiva o uguale al :date.", "alpha": ":attribute pu\xF2 contenere solo lettere.", "alpha_dash": ":attribute pu\xF2 contenere solo lettere, numeri e trattini.", "alpha_num": ":attribute pu\xF2 contenere solo lettere e numeri.", "array": ":attribute deve essere un array.", "attributes": { "address": "indirizzo", "age": "et\xE0", "available": "disponibile", "city": "citt\xE0", "content": "contenuto", "country": "paese", "date": "data", "day": "giorno", "description": "descrizione", "excerpt": "estratto", "first_name": "nome", "gender": "genere", "hour": "ora", "last_name": "cognome", "minute": "minuto", "mobile": "cellulare", "month": "mese", "name": "nome", "password_confirmation": "conferma password", "phone": "telefono", "second": "secondo", "sex": "sesso", "size": "dimensione", "time": "ora", "title": "titolo", "username": "nome utente", "year": "anno" }, "before": ":attribute deve essere una data precedente al :date.", "before_or_equal": ":attribute deve essere una data precedente o uguale al :date.", "between": { "array": ":attribute deve avere tra :min - :max elementi.", "file": ":attribute deve trovarsi tra :min - :max kilobyte.", "numeric": ":attribute deve trovarsi tra :min - :max.", "string": ":attribute deve trovarsi tra :min - :max caratteri." }, "boolean": "Il campo :attribute deve essere vero o falso.", "confirmed": "Il campo di conferma per :attribute non coincide.", "custom": { "attribute-name": { "rule-name": "custom-message" }, "current_password": { "password_check": "La password \xE8 errata" }, "renewal_id.*": { "required": "Scelta obbligatoria" } }, "date": ":attribute non \xE8 una data valida.", "date_format": ":attribute non coincide con il formato :format.", "different": ":attribute e :other devono essere differenti.", "digits": ":attribute deve essere di :digits cifre.", "digits_between": ":attribute deve essere tra :min e :max cifre.", "dimensions": "Le dimensioni dell'immagine di :attribute non sono valide.", "distinct": ":attribute contiene un valore duplicato.", "email": ":attribute non \xE8 valido.", "exists": ":attribute selezionato non \xE8 valido.", "file": ":attribute deve essere un file.", "filled": "Il campo :attribute deve contenere un valore.", "gt": { "array": ":attribute deve contenere pi\xF9 di :value elementi.", "file": ":attribute deve essere maggiore di :value kilobyte.", "numeric": ":attribute deve essere maggiore di :value.", "string": ":attribute deve contenere pi\xF9 di :value caratteri." }, "gte": { "array": ":attribute deve contenere un numero di elementi uguale o maggiore di :value.", "file": ":attribute deve essere uguale o maggiore di :value kilobyte.", "numeric": ":attribute deve essere uguale o maggiore di :value.", "string": ":attribute deve contenere un numero di caratteri uguale o maggiore di :value." }, "image": ":attribute deve essere un'immagine.", "in": ":attribute selezionato non \xE8 valido.", "in_array": "Il valore del campo :attribute non esiste in :other.", "integer": ":attribute deve essere un numero intero.", "ip": ":attribute deve essere un indirizzo IP valido.", "ipv4": ":attribute deve essere un indirizzo IPv4 valido.", "ipv6": ":attribute deve essere un indirizzo IPv6 valido.", "json": ":attribute deve essere una stringa JSON valida.", "lt": { "array": ":attribute deve contenere meno di :value elementi.", "file": ":attribute deve essere minore di :value kilobyte.", "numeric": ":attribute deve essere minore di :value.", "string": ":attribute deve contenere meno di :value caratteri." }, "lte": { "array": ":attribute deve contenere un numero di elementi minore o uguale a :value.", "file": ":attribute deve essere minore o uguale a :value kilobyte.", "numeric": ":attribute deve essere minore o uguale a :value.", "string": ":attribute deve contenere un numero di caratteri minore o uguale a :value." }, "max": { "array": ":attribute non pu\xF2 avere pi\xF9 di :max elementi.", "file": ":attribute non pu\xF2 essere superiore a :max kilobyte.", "numeric": ":attribute non pu\xF2 essere superiore a :max.", "string": ":attribute non pu\xF2 contenere pi\xF9 di :max caratteri." }, "mimes": ":attribute deve essere del tipo: :values.", "mimetypes": ":attribute deve essere del tipo: :values.", "min": { "array": ":attribute deve avere almeno :min elementi.", "file": ":attribute deve essere almeno di :min kilobyte.", "numeric": ":attribute deve essere almeno :min.", "string": ":attribute deve contenere almeno :min caratteri." }, "not_in": "Il valore selezionato per :attribute non \xE8 valido.", "not_regex": "Il formato di :attribute non \xE8 valido.", "numeric": ":attribute deve essere un numero.", "present": "Il campo :attribute deve essere presente.", "regex": "Il formato del campo :attribute non \xE8 valido.", "required": "Il campo :attribute \xE8 richiesto.", "required_if": "Il campo :attribute \xE8 richiesto quando :other \xE8 :value.", "required_unless": "Il campo :attribute \xE8 richiesto a meno che :other sia in :values.", "required_with": "Il campo :attribute \xE8 richiesto quando :values \xE8 presente.", "required_with_all": "Il campo :attribute \xE8 richiesto quando :values \xE8 presente.", "required_without": "Il campo :attribute \xE8 richiesto quando :values non \xE8 presente.", "required_without_all": "Il campo :attribute \xE8 richiesto quando nessuno di :values \xE8 presente.", "same": ":attribute e :other devono coincidere.", "size": { "array": ":attribute deve contenere :size elementi.", "file": ":attribute deve essere :size kilobyte.", "numeric": ":attribute deve essere :size.", "string": ":attribute deve contenere :size caratteri." }, "string": ":attribute deve essere una stringa.", "timezone": ":attribute deve essere una zona valida.", "unique": ":attribute \xE8 stato gi\xE0 utilizzato.", "unique_date_custom": ":attribute gi\xE0 utilizzato.", "uploaded": ":attribute non \xE8 stato caricato.", "url": "Il formato del campo :attribute non \xE8 valido." } });
})();

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//== Class Definition
var HostingManager = function ($) {

    var modalPanel = $('#app_modal_panel');
    var openModalBtn = $('.open-modal');

    var custom_inline_datepicker = function custom_inline_datepicker() {
        $('.custom_inline_datepicker').datepicker({
            todayHighlight: true,
            format: "dd-mm-yyyy",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    };

    var colorpicker = function colorpicker() {
        $('.cp_colorpicker').colorpicker({
            format: 'hex'
        });
    };

    var general = function general() {

        custom_inline_datepicker();
        colorpicker();

        $('.m_select2_4').select2();

        $('#m_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: "dd-mm-yyyy"
        });

        openModalBtn.on('click', function (el) {
            el.preventDefault();
            openModalAction(this);
        });

        modalPanel.on('click', 'button[type="submit"]', function (el) {
            el.preventDefault();
            var dataTarget = $('[name="' + modalPanel.attr('data-target') + '"]');
            var dataTableRef = $('.dataTable');

            var serviceForm = $(el.target.closest('form'));

            $.ajax(serviceForm.attr('action'), {
                method: serviceForm.attr('method'),
                data: serviceForm.serialize(), // faccio la serializzazione dei dati per inviare tutti i campi del form
                success: function success(data) {

                    modalPanel.modal('hide');
                    toastr.success(data.message);

                    if (dataTarget.length) {
                        dataTarget.append('<option value="' + data.object.id + '" selected="selected">' + data.object.name + '</option>');
                    }
                    if (dataTableRef.length) {
                        dataTableRef.DataTable().ajax.reload();
                    }
                },
                error: function error(resp) {

                    resp = JSON.parse(resp.responseText);
                    modalPanel.find("span[data-field]").html('');

                    if (resp.errors) {
                        jQuery.each(resp.errors, function (key, value) {
                            modalPanel.find("span[data-field='" + key + "']").html('<strong>' + value + '</strong>');
                        });
                    } else {
                        toastr.error(resp.message);
                        modalPanel.modal('hide');
                    }
                }
            });
        }).on('click', '.cancel', function (el) {
            el.preventDefault();
            modalPanel.modal('toggle');
        });
    };

    var openModalAction = function openModalAction(obj) {
        modalPanel.attr('data-target', '');
        var modalTitle = $(obj).attr('data-original-title') || '';
        $.ajax(obj.href, {
            method: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function success(data) {

                if (data.view) {
                    modalPanel.find('.modal-title').html(modalTitle);
                    modalPanel.find('.modal-body').html(data.view);
                    modalPanel.attr('data-target', $(obj).attr('data-target'));
                }

                custom_inline_datepicker();
                colorpicker();

                modalPanel.modal('show');
            },
            error: function error(resp, status, _error) {
                resp = JSON.parse(resp.responseText);
                toastr.error(resp.message);
            }
        });
    };

    var dashboardChart = function dashboardChart() {
        //== Activities Charts.
        //** Based on Chartjs plugin - http://www.chartjs.org/
        if ($('#m_chart_activities').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_chart_activities").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: [Lang.get('messages.january'), Lang.get('messages.february'), Lang.get('messages.march'), Lang.get('messages.april'), Lang.get('messages.may'), Lang.get('messages.june'), Lang.get('messages.july'), Lang.get('messages.august'), Lang.get('messages.september'), Lang.get('messages.october'), Lang.get('messages.november'), Lang.get('messages.december')],
                datasets: [{
                    label: Lang.get('messages.total_earning'),
                    backgroundColor: gradient, // Put the gradient here as a fill color
                    borderColor: '#0dc8de',

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mApp.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: dashboardServicesDataChart
                }]
            },
            options: {
                title: {
                    display: false
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    };

    var dashboardCalendar = function dashboardCalendar() {
        if ($('#m_calendar').length === 0) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        $('#m_calendar').fullCalendar({
            isRTL: mUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            //defaultDate: moment('2018-08-15'),
            events: dashboardEvents,

            eventRender: function eventRender(event, element) {
                if (element.hasClass('fc-day-grid-event')) {
                    element.data('content', event.description);
                    element.data('placement', 'top');
                    mApp.initPopover(element);
                } else if (element.hasClass('fc-time-grid-event')) {
                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                }
            }
        });
    };

    var serviceRenewalsDataTable = function serviceRenewalsDataTable() {
        var obj = $('#service_renewals_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],
            headerCallback: dataTableHeaderCallback,
            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "deadline" }, { data: "status" }, { data: "amount" }, { data: "actions", name: 'action', orderable: false, searchable: false }],

            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }, {
                targets: [1],
                render: function render(data, type, full, meta) {
                    if (data == null) return '';
                    return moment(data).format('DD-MM-YYYY');
                }
            }, {
                targets: [3],
                render: $.fn.dataTable.render.number('.', ',', 2, '&euro; ')
            }]
        });

        dataTable.on('click', '.update-transition', function (el) {
            el.preventDefault();

            var _self = this;
            var _currentTransition = $(_self).data('transition');
            var _defaultTransition = $(_self).data('transition-default');

            $.ajax(_self.href, {

                method: "PATCH",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function success(data) {
                    toastr.success(data.message);
                    dataTable.ajax.reload();

                    if (_currentTransition == _defaultTransition) {
                        swal({
                            title: Lang.get('messages.renewal_create_next_title'),
                            text: Lang.get('messages.renewal_create_next_desc'),
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: Lang.get('messages.yes_procede')
                        }).then(function (result) {
                            if (result.value) {
                                openModalBtn.trigger("click");
                            }
                        });
                    }
                },
                error: function error(resp, status, _error2) {
                    resp = JSON.parse(resp.responseText);
                    toastr.error(resp.message);
                }
            });
        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
        editDataTableRecord(dataTable);
    };

    var providersDataTable = function providersDataTable() {
        var obj = $('#providers_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "name" }, { data: "label" }, { data: "actions", name: 'action', orderable: false, searchable: false }],
            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }, {
                targets: [2],
                render: function render(data, type, full, meta) {
                    if (data == null) return '';
                    var color = typeof data !== 'undefined' ? 'style="background:' + data + '"' : '';
                    return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data + '</span>';
                }
            }]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
    };

    var customersDataTable = function customersDataTable() {
        var obj = $('#customers_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "name" }, { data: "email" }, { data: "phone" }, { data: "address" }, { data: "actions", name: 'action', orderable: false, searchable: false }],
            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
    };

    var servicesDataTable = function servicesDataTable() {
        var obj = $('#services_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[4, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "name" }, { data: "provider", orderable: false }, { data: "service_type", orderable: false }, { data: "deadline" }, { data: "amount" }, { data: "status" }, { data: "unresolved" }, { data: "actions", name: 'action', orderable: false, searchable: false }],
            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }, {
                targets: 1,
                render: function render(data, type, full, meta) {
                    var image = full.screenshoot !== null ? '<img src="' + full.screenshoot + '">' : '';

                    var label, health;
                    if (full.health == 1) {
                        label = "success";
                        health = Lang.get('messages.online');
                    } else {
                        label = "danger";
                        health = Lang.get('messages.offline');
                    }
                    var health_html = full.url ? '<span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + health + '</span>' : '';

                    var html = '<div class="m-card-user m-card-user--sm">' + '  <div class="m-card-user__pic">' + '    <div class="m-card-user__no-photo">' + image + '</div>' + '  </div>' + '  <div class="m-card-user__details">' + '    <span class="m-card-user__name">' + data + '</span>' + '    ' + health_html + '  </div>';
                    '</div>';
                    return html;
                }
            }, {
                targets: [2],
                render: function render(data, type, full, meta) {
                    if (data == null) return '';
                    var color = typeof data.label !== 'undefined' ? 'style="background:' + data.label + '"' : '';
                    return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data.name + '</span>';
                }
            }, {
                targets: [3],
                render: function render(data, type, full, meta) {
                    return data == null ? '' : data.name;
                }
            }, {
                targets: [4],
                render: function render(data, type, full, meta) {
                    if (data == null) return '';
                    return moment(data).format('DD-MM-YYYY');
                }
            }, {
                targets: [5],
                render: $.fn.dataTable.render.number('.', ',', 2, '&euro; ')
            }, {
                targets: [7],
                render: function render(data, type, full, meta) {
                    var label = data > 0 ? 'danger' : 'secondary';
                    return '<span class="m-badge m-badge--' + label + '">' + data + '</span>';
                }
            }]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
    };

    var serviceTypeDataTable = function serviceTypeDataTable() {
        var obj = $('#serviceType_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "name" }, { data: "actions", name: 'action', orderable: false, searchable: false }],

            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }]
        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
        editDataTableRecord(dataTable);
    };

    var renewalFrequenciesDataTable = function renewalFrequenciesDataTable() {
        var obj = $('#renewalFrequencies_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "value" }, { data: "type" }, { data: "actions", name: 'action', orderable: false, searchable: false }],

            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }]
        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
        editDataTableRecord(dataTable);
    };

    var userDataTable = function userDataTable() {
        var obj = $('#users_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t            <'row'<'col-sm-12'tr>>\n\t\t\t            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', {
                text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                className: '',
                action: function action(e, dt, node, config) {
                    deleteAllDataTableRecord(dataTable, deleteAllRoute);
                }
            }],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [{ data: "id" }, { data: "avatar" }, { data: "name" }, { data: "email" }, { data: "role" }, { data: "actions", name: 'action', orderable: false, searchable: false }],

            columnDefs: [{
                targets: [0],
                width: '30px',
                className: 'dt-right',
                orderable: false,
                render: function render(data, type, full, meta) {
                    return "\n                                <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                                    <input type=\"checkbox\" name=\"delete_data[]\" value=\"" + data + "\" class=\"m-checkable\">\n                                    <span></span>\n                                </label>";
                }
            }, {
                targets: [1],
                render: function render(data, type, full, meta) {
                    if (data == null) return data;
                    return '<img class="m--img-rounded" width="50" src="' + data + '"/>';
                }
            }]
        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
    };

    var dataTableHeaderCallback = function dataTableHeaderCallback(thead, data, start, end, display) {
        thead.getElementsByTagName('th')[0].innerHTML = "\n                    <label class=\"m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand\">\n                        <input type=\"checkbox\" value=\"\" class=\"m-group-checkable\">\n                        <span></span>\n                    </label>";
    };

    var dataTableSelectAllSupport = function dataTableSelectAllSupport(dataTable) {
        dataTable.on('change', '.m-group-checkable', function () {
            var set = $(this).closest('table').find('td:first-child .m-checkable');
            var checked = $(this).is(':checked');

            $(set).each(function () {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                } else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        dataTable.on('change', 'tbody tr .m-checkbox', function () {
            $(this).parents('tr').toggleClass('active');
        });
    };

    var editDataTableRecord = function editDataTableRecord(dataTable) {
        dataTable.on('click', '.edit', function (el) {
            el.preventDefault();

            openModalAction(this);
        });
    };

    var deleteDataTableRecord = function deleteDataTableRecord(dataTable) {

        dataTable.on('click', '.deleteDataTableRecord', function (el) {
            el.preventDefault();
            var _self = this;
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.confirm_delete')
            }).then(function (result) {

                if (result.value) {
                    var action = _self.href;
                    $.ajax(action, {

                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function success(data) {
                            if (data.redirect && data.redirect != '' && data.redirect != window.location.href) {
                                window.location.replace(data.redirect);
                            } else {
                                toastr.success(data.message);
                                dataTable.ajax.reload();
                            }
                        },
                        error: function error(resp, status, _error3) {
                            resp = JSON.parse(resp.responseText);
                            toastr.error(resp.message);
                        }

                    });
                }
            });
        });
    };

    var deleteAllDataTableRecord = function deleteAllDataTableRecord(dataTable, deleteAllRoute) {

        var deleteCheckbox = $("input[name='delete_data[]']:checked");
        var ids = deleteCheckbox.map(function () {
            return $(this).val();
        }).get();
        //var _self = this;

        if (ids.length > 0) {
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.confirm_delete')
            }).then(function (result) {
                var join_selected_values = ids.join(",");

                if (result.value) {
                    $.ajax(deleteAllRoute, {
                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'ids': join_selected_values
                        },

                        success: function success(data) {

                            if (data.redirect && data.redirect != '') {
                                window.location.replace(data.redirect);
                            } else {
                                dataTable.ajax.reload();
                                toastr.success(data.message);
                            }
                        },
                        error: function error(resp, status, _error4) {
                            resp = JSON.parse(resp.responseText);
                            toastr.error(resp.message);
                        }

                    });
                }
            });
        }
    };

    var openAlertBeforeSubmit = function openAlertBeforeSubmit() {
        $('.openAlertBeforeSubmit').on('click', function (el) {
            el.preventDefault();
            var _self = this;

            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.yes_procede')
            }).then(function (result) {
                if (result.value) {
                    $(_self).closest('form').submit();
                }
            });
        });
    };

    var deleteRecord = function deleteRecord() {

        $('.deleteRecord').on('click', function (el) {
            el.preventDefault();

            var _self = this;
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.confirm_delete')
            }).then(function (result) {
                if (result.value) {
                    var action = _self.href;
                    $.ajax(action, {

                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function success(data) {
                            if (data.redirect && data.redirect != '') {
                                window.location.replace(data.redirect);
                            } else {
                                toastr.success(data.message);
                            }
                        },
                        error: function error(resp, status, _error5) {
                            resp = JSON.parse(resp.responseText);
                            toastr.error(resp.message);
                        }

                    });
                }
            });
        });
    };

    var customerRenewalManager = function customerRenewalManager() {

        $(".renewal-service-row input[name^=tmp_renewal_id]").on('change', function (e) {
            $(this).closest('.m-radio-inline').find('input[name^=renewal_id]').val($(this).val());
        });

        $('.renewal-service-row .suspend').on('change', function (e) {
            var renewal_service_row = $(this).closest('.renewal-service-row');
            renewal_service_row.nextAll().find('input[name^=tmp_renewal_id]').prop("disabled", true);
            if (renewal_service_row.nextAll().find('.suspend:not(:checked)').length > 0) {
                swal({
                    title: Lang.get('messages.customer_renewal_manager_title'),
                    text: Lang.get('messages.customer_renewal_manager_desc'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: Lang.get('messages.yes_procede')
                }).then(function (result) {
                    if (result.value) {
                        renewal_service_row.nextAll().find('.suspend').prop("checked", true).trigger('change');
                    } else {
                        renewal_service_row.nextAll().find('.renew:checked').prop("disabled", false);
                        renewal_service_row.find('.renew').prop("checked", true).trigger('change');
                    }
                });
            }
        });

        $('.renewal-service-row .renew').on('change', function (e) {
            $(this).closest('.renewal-service-row').next().find('input[name^=tmp_renewal_id]').prop("disabled", false);
        });
    };

    var sendCustomerReminder = function sendCustomerReminder() {
        $('.sendCustomerReminder').on('click', function (e) {
            e.preventDefault();
            var _self = this;
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.customer_reminder_alert_status'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.yes_procede')
            }).then(function (result) {

                if (result.value) {
                    var action = _self.href;
                    $.ajax(action, {

                        method: "GET",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function success(data) {
                            data.type == 'warning' ? toastr.warning(data.message) : toastr.success(data.message);
                        },
                        error: function error(resp, status, _error6) {
                            resp = JSON.parse(resp.responseText);
                            toastr.error(resp.message);
                        }

                    });
                }
            });
        });
    };

    return {
        init: function init() {
            dashboardChart();
            dashboardCalendar();
            general();
            serviceRenewalsDataTable();
            providersDataTable();
            customersDataTable();
            userDataTable();
            serviceTypeDataTable();
            renewalFrequenciesDataTable();
            servicesDataTable();
            deleteRecord();
            openAlertBeforeSubmit();
            customerRenewalManager();
            sendCustomerReminder();
        }
    };
}(jQuery);

//== Class Initialization

jQuery(document).ready(function () {
    HostingManager.init();
});
