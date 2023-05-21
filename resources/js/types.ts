interface Option {
  id: String
  option: String
  error: Boolean | undefined
}

interface Field {
  id: String
  name: String
  description: any
  require: Boolean
  type: String
  options: Array<Option> | undefined
  error: Boolean | undefined
}

interface Form {
  id: String | null
  title: String
  description: String | undefined
  created_at: Date | null
  exp_date: Date | null
  fields: Array<Field>
  is_active: Boolean
  error: Boolean | undefined
}

interface FieldValue {
  id: String
  name: String
  type: String
  options: Option[] | undefined
  value: String
  required: Boolean
  error: Boolean | undefined
}

// @ts-ignore
export {Option, Field, Form, FieldValue}
