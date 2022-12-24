export enum Unit {
  GRAM = "gr",
  MILLILITER = "ml",
  PEACE = "pc",
}

export type Maybe<T> = T | null;

export type Nutrient = {
  name: string;
  category?: Category;
  carbs_in_hundred: number;
  unit: Unit;
  standard_amount: number;
};

export type Category = {
  name: string;
  nutrients?: Array<Nutrient>;
};

export type Meal = {
  name: string;
  nutrients?: Nutrient;
};
