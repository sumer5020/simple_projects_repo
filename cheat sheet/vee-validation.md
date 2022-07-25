# Why Vee-Validate?

A form is only as good as the data it collects from your user.

Allowing your users to submit forms with required fields left blank, or not checking that an input’s content is what you are expecting, can lead to unusable data and unreliable databases.

Simply put, a form that does not collect the data you need, as you need it, is not serving its full purpose.

In this course we are going to learn how to validate any form inside a Vue 3 application by leveraging the power of Vee-Validate.

## Why use a library? And why Vee-Validate?

Form validation can get very complex, very quickly. To do it right, you’d need to hand-craft everything from connecting your inputs into a central parser to check the validity of the data, to creating custom rules, and handling different input states.

While you could do all this from scratch, your precious development time is better spent on building application logic, polishing the user experience of your form, and ensuring it’s highly accessible. By implementing a plug-and-play solution like Vee-Validate, you’ll free up more time that can be devoted to these considerations.

## What you’ll learn

- Validate single fields and full forms - Throughout this course we will learn how to use Vee-Validate to validate both a single input in our applications, and then grow that to validating a full form with a defined set of rules.
- Handle errors - Next, we will learn together how to check and present validation errors to our users as they progress through filling out or forms.
- Key API differences - We will explore the different ways of obtaining information about the state of our forms, for example, how to tell when an error is present within a field with directly vs extracting all the form’s errors at once.
- YUP - Later in the course, we will explore the benefits of using an out of the box validation methods library, YUP, and it’s benefits as opposed to writing your own.
Best practices - We will implement and understand together the libraries best practices such as how to handle form submit events or the benefits of lazy vs aggressive validation.
So if you’re ready to feel confident validating any form with this handy validation library, I’ll see you in the rest of the course.

<br><hr><br>

# Setting Up

In this lesson, we’re going to get started with the vee-validate library and validate our first form fields!

## Getting started

If you haven’t done it already, please grab a copy of the course’s repository from the Lesson Resources below. I’ve set us up with a sample login form that includes an email and a password field.

For the sake of continuity, we’re using the components we created in Vue Mastery’s Vue 3 Forms course, but you can use your own form components if you prefer. The details of how the component works are not relevant for this course. It just needs to be able to v-model its state to its parent. Also it would be a plus if it is able to display labels and error messages.

With that out of the way, let’s get set up by adding vee-validate into our project.

Run the following command in your terminal:

```bash
yarn add vee-validate@next
# or
npm i vee-validate@next --save
```

There are two ways we can use vee-validate in Vue 3. Through a template-based component that is provided to us by the library called Field, or through the use of composition API.

The component approach is the simplest way of using vee-validate, but it does require us to use their pre-bundled input component. Since we want to leverage our custom-made components and have as much control over our form as we can, we are going to use the Composition API approach. The library exposes a few intuitive composition functions that allow us to define which pieces of data on our state we are going to use as fields, which need to be validated.

If you have never used the Composition API before with Vue 3, this would be a good moment to take a look at the Vue 3 Composition API course here on Vue Mastery before the next lesson.

## Validating our email input

Let’s head over to LoginForm.vue and start working on validating our email input. Notice that we already have a setup method where we are declaring an onSubmit method, so that our form’s @submit event has something tied to it.

### 📃 LoginForm.vue

```vue
<template>
  <form @submit.prevent="onSubmit">
    <BaseInput
      label="Email"
      type="email"
    />

    <BaseInput
      label="Password"
      type="password"
    />

    <BaseButton
      type="submit"
      class="-fill-gradient"
    >
      Submit
    </BaseButton>
  </form>
</template>

<script>
export default {
  setup () {
    function onSubmit () {
      alert('Submitted')
    }

    return {
      onSubmit
    }
  }
}
</script>
```

Let’s start by importing the composition function useField from vee-validate.

### 📃 LoginForm.vue

```vue
import { useField } from 'vee-validate'
export default {
  ...
}
```

The useField function tells vee-validate that we are creating a form field that we want to have validated. In its simplest form, it accepts two parameters:

A String with the name of the model for this field. In our case, we will simply call it email.
A function to check if the value of the field is valid or not.
Let’s use this function to set up validation for our email input.

### 📃 LoginForm.vue

```vue
setup () {
  [...]

  const email = useField('email', function(value) {
    if (!value) return 'This field is required'
  
    return true
  })
  
  return {...}
}
```

We have set the name email for our model of this input, and we have created a new function that will validate the email input every time it updates.

Notice the form is receiving a value param. We then check if this value is empty, and if it is, we return a String with an error message.

Validation functions in vee-validate can return either true to indicate that the field is valid, or a string that will represent the error message we will display for the user.

Let’s take this a bit further, and use a regex to check that the value is a valid email address.

### 📃 LoginForm.vue

```vue
setup () {
  [...]

  const email = useField('email', function(value) {
    if (!value) return 'This field is required'

    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (!regex.test(String(value).toLowerCase())) {
      return 'Please enter a valid email address'
    }
  
    return true
  })
  
  return {...}
}
```

Here we are checking to see if the value that we are getting from the email field passes the regex test. If it doesn’t, we return a different string with an error that clarifies what we want from the user.

This gives us the flexibility to do all types of checks and validations here for our fields, and return a different error message for each one.

Notice that we are currently saving the result from the useField method in an email constant.

This email constant is an object that contains two very important properties.

The first one, value, is a Vue ref or reactive value. We will use this value to keep the data-binding between our input component and the state.

Let’s use this value property of the email object to v-model bind our input in our template.

First, we will return the email.value property from our setup function so that we can use it in our template.

### 📃 LoginForm.vue

```
const email = useField(...)

return {
  onSubmit,
  email: email.value
}
```

We are exporting this value property as email so that it is clearer in our template what is happening with the binding.

We can now go to the template of our .vue file and add a v-model binding to our BaseInput for the email field, and bind it to the email ref we just exported in setup.

### 📃 LoginForm.vue

```vue
<template>
  [...]
  <BaseInput
    label="Email"
    type="email"
    v-model="email"
  />
  [...]
</template>
```

The second important property that the useField function gives us is the errorMessage property.

Whenever our validation function fails and returns an error message, it will be stored in this property of the email constant. Let’s return this property as well in our setup function, and bind it to the :error prop of our BaseInput component.

### 📃 LoginForm.vue

```vue
const email = useField(...)

return {
  onSubmit,
  email: email.value,
  emailError: email.errorMessage
}
```

Now, let’s go to the template and bind the emailError we just exported to our BaseInput's error prop.

```vue
<template>
  [...]
  <BaseInput
    label="Email"
    type="email"
    v-model="email"
    :error="emailError"
  />
  [...]
</template>
```

If we check this out in the browser, we’ll see that as we start typing, the validation fires. Since we’re not entering a valid email address, the emailError property is set, and our error message is displayed!

<https://firebasestorage.googleapis.com/v0/b/vue-mastery.appspot.com/o/flamelink%2Fmedia%2Femailerror.opt.jpg?alt=media&token=56701911-6048-4719-9122-156a877ab091>

### Cleaning up

This is working great so far, but I want to do a bit of a cleanup with how we are setting up our email constant, and briefly talk about JavaScript destructuring.

Notice how the useFieldmethod returns an object. In this object there are quite a few properties, and we’re capturing them all (as a full object) inside the email constant.

```vue
const email = useField(...)
```

Then, we go ahead and access those properties of the email object in our return statement, and pass return them like so:

```vue
return {
  onSubmit,
  email: email.value,
  emailError: email.errorMessage
}
```

This perfectly ok to do, and this verboseness can sometimes lead to code clarity, which is always a good thing. But often when working with the Composition API you will notice that most resources will make use of JavaScript destructuring.

Destructuring in itself is beyond the scope of this course, but MDN has a great article that explains it in detail.

The previous example, written using JavaScript destructuring, looks like this:

```vue
const { value, errorMessage } = useField(...)

return {
  onSubmit,
  email: value,
  emailError: errorMessage
}
```

The property value and errorMessage of the object returned by useField are now readily available to us as variables, so we can pass them directly into the return statement.

There’s one last bit I want to show you before we move on. There are times we will need to rename these properties for clarity, or because they may conflict with one another. In JavaScript, we can rename a destructured property by adding a : colon after the property in the destructured syntax, and the new name.

Let me show you a working example. Let’s rename the value to email, and the errorMessage to emailError.

```vue
const { value: email, errorMessage: emailError } = useField(...)

return {
  onSubmit,
  email: email,
  emailError: emailError
}
```

Both syntaxes are completely fine, so feel free to use whichever makes more sense to you with our examples.

### Wrapping up

Now that we’ve successfully validated our first form component, we are ready to move on to the next lesson and look at defining our validations at form-level using a schema.

<br><hr><br>

# Validating at form level

Now that we know how to validate a single input field in our forms, let’s take it a step further and learn how to set up our validations at the form level. This will allows us to define rules for our whole form at once without so much code “clutter”.

## Validating the password field

If we were to continue with the current strategy, in order to validate our password field we would now add a new useField call for it. In a form with two fields like this login form, this may not seem like a big issue since its only a couple more lines of code. But when we are dealing with substantially bigger forms, like a registration form for example, this can quickly become hard to manage.

Luckily there is a very similar way to declare how we want our forms to be validated all at once: the useForm function.

Let’s first add to our import statement on the top of LoginForm.vue the useField and useForm methods — they are both imported from the vee-validate package.

### 📃 LoginForm.vue

```vue
import { useField, useForm } from 'vee-validate'
```

When validating at form level, we want to create an object that will represent the structure of our form’s model, or data — this is usually referred to as the Schema.

We know that we have two things we have to capture from our user here, the email and password, so let’s start by creating an object with these properties inside the setup function.

### 📃 LoginForm.vue

```vue
const validations = {
  email: value => {

  },
  password: value => {

  }
}
```

Notice that each of our properties point to a function, this function is what vee-validate will use when validating each of our inputs.

Notice also that the function receives a single param: value. This value contains the data that the user is entering into our form inputs.

We already have a function to validate our email that we wrote on the previous lesson, so let’s cut it out of the useField call we had for our email input and paste it into our validations object’s email property instead.

### 📃 LoginForm.vue

```vue
const validations = {
  email: value => {
    if (!value) return 'This field is required'

    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (!regex.test(String(value).toLowerCase())) {
      return 'Please enter a valid email address'
    }

    return true
  },
  password: value => {

  }
}
```

```vue
const { value: email, errorMessage: emailError } = useField('email')
```

Notice that our useField call remains, but only with the first parameter 'email'. Be careful, this string 'email' must match the email property of our validation’s schema. If the property inside of our validations object was called emailAddress for example, our useField call here would have the string 'emailAddress' instead to reflect it.

Now that we’ve refactored everything, let’s add the actual validation method for our password field. We will simply check that the value exists and that it has a length greater than 0 — commonly known as required.

### 📃 LoginForm.vue

```vue
password: value => {
  const requiredMessage = 'This field is required'
  if (value === undefined || value === null) return requiredMessage
  if (!String(value).length) return requiredMessage

  return true
}
```

## Hooking up our form to the ‘validationSchema’

Now that our validations are ready, we have to tell vee-validate that we want it to use this object as the validation’s schema. We can do this with the useForm method we imported earlier.

The useForm method takes an object as its only parameter. Within this object we can define several configuration properties, but the one we are interested in right now is called validationSchema.

Let’s set this property to our validations object.

### 📃 LoginForm.vue

```vue
const validations = {
  email: value => {
    if (!value) return 'This field is required'

    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (!regex.test(String(value).toLowerCase())) {
      return 'Please enter a valid email address'
    }

    return true
  },
  password: value => {
    const requiredMessage = 'This field is required'
    if (value === undefined || value === null) return requiredMessage
    if (!String(value).length) return requiredMessage

    return true
  }
}

useForm({
  validationSchema: validations
})
```

Now that vee-validate knows how to validate our form’s data, let’s make sure that we are correctly binding the v-model for the password, as well as getting any possible errors.

Just like we did for our email input, we are going to use the useField method to get them both and return them from our setup method so that we can use them on our template.

### 📃 LoginForm.vue

```vue
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')

return {
  onSubmit,
  email,
  emailError,
  password,
  passwordError
}
```

Notice that we are using JavaScript object destructuring one more time to extract the value and errorMessage out of the password field object, and renaming them to password and passwordError respectively, so that we can tell them apart.

Let’s now go to the template and set up the v-model and error bindings for the password input.

### 📃 LoginForm.vue

```vue
<BaseInput
  label="Password"
  type="password"
  v-model="password"
  :error="passwordError"
/>
```

## Wrapping up

Fire up your browser and start typing into both your email and password fields. Notice how as you type the first character, the validation triggers and the methods that we added for each one respectively calculate if the fields are valid or not.

https://firebasestorage.googleapis.com/v0/b/vue-mastery.appspot.com/o/flamelink%2Fmedia%2Finvalid_form.opt.jpg?alt=media&token=cbdbc196-aa2c-4291-88a8-1327c5fb55a2

Now that our form’s validation logic is centralized, let’s learn how to also centralize our error messages using useForm so that we don’t have to call useField manually for every single field we want to add to our form. We’ll handle that in the next lesson. See you there!
