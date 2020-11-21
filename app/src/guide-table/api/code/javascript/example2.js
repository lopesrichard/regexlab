/* 3. Doing a global search and getting the results */

const regex = /\d([a-z])/g;
const string = '1a2b3c';
const match = string.match(regex);
const matchAll = string.matchAll(regex);

console.log(match); // ["1a", "2b", "3c"]
console.log(Array.from(matchAll));
/*
  [
      ["1a", "a", index: 0, input: "1a2b3c"]
      ["2b", "b", index: 2, input: "1a2b3c"]
      ["3c", "c", index: 4, input: "1a2b3c"]
  ]
*/

/* 4. Replacing a text */

const string = '1a2b3c';
const replacement = '@';
const regex = /\d([a-z])/;
console.log(string.replace(regex, replacement)); // @2b3c

/* 5. The same but this time using global flag */

const string = '1a2b3c';
const regex = /\d([a-z])/g;
console.log(string.replace(regex, replacement)); // @@@

/* 6. Splitting a string into an array */

const string = '1a2b3c';
const regex = /\d/;
console.log(string.split(regex)); // ["", "a", "b", "c"]
