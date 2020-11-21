// In javascript, regular expressions
// are performed by the RegExp class.
//
// Ex: const regex = new RegExp('\d');
//
// But, there's a synthetic sugar for this,
// as you'll notice bellow, we just need
// to use slashes to create an instance of RegExp
//
// You may ask. When should I use the more verbose version?
// The answer is: When you need to create a regex dinamically
//
// Ex:
// const listOfNonAllowedChars = 'abcd';
// const regex = new RegExp(`[^${listOfNonAllowedChars}]`);

/* 1. Doing just a check using the simplest method */

const regex = /^\d([a-z])$/;
const string = '1a';

if (regex.test(string)) {
  // do something
}

/* 2. Doing a search and getting the result */

const regex = /^\d([a-z])$/;
const string = '1a';
const match = string.match(regex);

console.log(match[0]); // 1a
console.log(match[1]); // a
