## Account Management

This is a Simple Account Management System, complete with back and front-end Account Authorization.

This are the following frameworks that uses to make this works

- [Laravel 8](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- [Vuex](https://vuex.vuejs.org/)
- [Vue Router](https://router.vuejs.org/)
- [BootstrapVue](https://bootstrap-vue.org/)
- [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2)
- [Vue Good Table](https://xaksis.github.io/vue-good-table/)

## Guide Back-end

It is Preferred to use this style to make a Permission

> *Table Name* . *Method*

note that it is much preferable to make it all caps.

I use these method for reference
- CREATE : create a record
- READ : retrieve the records
- UPDATE : update a record
- DELETE : delete a record
- PROVIDE : pivot specific method

For Back end Authorization, Check [Laravel Authorization](https://laravel.com/docs/8.x/authorization).

## Guide Front-end

the Vue included will automatically checks the user and retrieve all available Permissions

to check if the user is authorize just import the necessary utility
> import permit from '@/utils/permit'

to check permission just use the function
> permit('PERMISSION')
or
> permit(['PERMISSION1', 'PERMISSION2'])

the first will check if the user is authorized, while the latter will check if user is authorized in any of the given Permissions

## Background
I write this code as a past time during quarantine.

I'm trying to find a simple account management and only found either back-end or front-end but not as a whole.  Hence I write this code with all my self learned knowledge, to make a simple authorization complete with an implementation of what I want and think of as necessary.

This may be a mash up code due to my own incompetence.  Even though, may this code help/provide guidance for all beginner programmer like myself.

## License

This is licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Donation???
As much as I want to ask for donation, my code just ends up as a hard to read code so I will refrain for asking any.

Currently I am just a meanly IT Staff who only work with internet connection and code as a past time(not work).
 
Though I am grateful to know if this code somehow or another helps other programmers

Just feel free to contact me
email: russel_cruz01@gmail.com
contact: +639563782994
facebook: https://www.facebook.com/russelcruz01