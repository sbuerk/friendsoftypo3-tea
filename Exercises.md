# Exercises for the TDD workshop

## Getting started

1. Clone the repository and check out the `workshop/t3dd22` branch.
2. Install the composer dependencies.
3. Get the unit tests to run on the command line:
   `composer ci:tests:unit`
4. (optional) Get the unit tests to run in PhpStorm.
   ([configuration](https://github.com/TYPO3-Documentation/tea/blob/main/Documentation/Running.rst#id18))

## Writing new features

For all these features, please make sure to create them using
**test-driven development** exclusively. Also, please remember to always create
a **test list** before you start writing the actual tests.

### Adding prices

We want to make our little tea hobby a business, which includes tea parlor.
So all items need to have a price.

(For keeping things simple, we'll use floats for the prices. In real-world
scenarios, this would be a bad idea due to floats not being able to precisely
represent some numbers.=

1. Add a float `price` property to the `Tea` model, including getter and setter.
   The price can be set to zero or a positive float, but not negative.
   If a negative price is set, an `InvalidArgumentException` is thrown.
2. In the same vein, add a `price` to the `Flavor` model.
3. Add a `getTotalPrice` to `FlavoredTeaBeverage` (but no setter and no
   property).
   This price should be the total of the prices of the base tea and all flavors,
   and should be zero if no tea and no flavors have been set.

### Adding a discount

1. Add a float `discount` property with getter and setter to
   `FlavoredTeaBeverage`. It can be zero or positive, but not negative
   (again with the corresponding check in the setter).
2. Add a bool `hasDiscount` to `FlavoredTeaBeverage`. It should return `true`
   if the discount is positive, and `false` otherwise.
3. The discount should be *subtracted* from the total in `getTotalPrice`.
   However, the total price can only be reduced to zero (i.e., a free beverage),
   but it can not become negative (i.e., no "pay me to get this beverage").

## Functional tests (advanced)

1. Get the functional tests to work (either using a local or Docker database,
   or using the ddev database).
2. Add repositories and functional tests for the newly added models.
3. Cover the new properties with tests for the repositories.
   (You'll need to add SQL columns and TCA entries for this.)
4. Cover the associations/relations with tests.
